<?php

namespace App\Controllers;

use App\Models\InternshipModel;
use App\Models\StudentModel;
use App\Models\LecturerModel;
use App\Models\CourseModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $role       = session()->get('role');
        $userId     = session()->get('userId');
        $isWadek    = ($role === 'wadek1' || session()->get('is_wadek') === true);
        $activeRole = session()->get('active_role') ?? $role;

        // Context role dashboard aktif (mendukung switch role untuk dosen & wadek)
        $dashboardRole = ($role === 'dosen' || $isWadek) ? $activeRole : $role;

        $data = [
            'title'      => 'Dashboard SIMAGANG',
            'role'       => $role,
            'activeRole' => $activeRole,
            'isWadek'    => $isWadek,
            'userName'   => session()->get('userName'),
        ];

        switch ($dashboardRole) {
            case 'mahasiswa':
                $studentModel    = new StudentModel();
                $internshipModel = new InternshipModel();
                $student         = $studentModel->getStudentWithDetails($userId);
                $data['student'] = $student;

                $internships = $student ? $internshipModel
                    ->select('internships.*, supervisor_assignments.status as assignment_status, lecturers_user.name as supervisor_name')
                    ->join('supervisor_assignments', 'supervisor_assignments.internship_id = internships.id', 'left')
                    ->join('lecturers', 'lecturers.id = supervisor_assignments.lecturer_id', 'left')
                    ->join('users as lecturers_user', 'lecturers_user.id = lecturers.user_id', 'left')
                    ->where('internships.student_id', $student['id'])
                    ->orderBy('internships.id', 'DESC')
                    ->findAll() : [];
                $data['internships'] = $internships;

                // Hitung statistik penting
                $data['activeInternshipsCount'] = count(array_filter($internships, fn($i) => $i['status'] === 'INTERNSHIP_ACTIVE'));

                // Total Logbook yang sudah terisi
                $internshipIds = array_column($internships, 'id');
                $logbookCount  = 0;
                if (!empty($internshipIds)) {
                    $logbookModel = new \App\Models\InternshipLogbookModel();
                    $logbookCount = $logbookModel->whereIn('internship_id', $internshipIds)->countAllResults();
                }
                $data['logbookCount'] = $logbookCount;

                // Konversi MK
                $conversionModel         = new \App\Models\ConversionRequestModel();
                $data['conversionCount'] = $student ? $conversionModel->where('student_id', $student['id'])->countAllResults() : 0;

                return view('mahasiswa/dashboard', $data);

            case 'tu':
                $internshipModel          = new InternshipModel();
                $data['pendingApprovals'] = $internshipModel->where('status', 'SUBMITTED')->countAllResults();
                $data['totalActive']      = $internshipModel->where('status', 'INTERNSHIP_ACTIVE')->countAllResults();
                return view('tu/dashboard', $data);

            case 'kaprodi':
                $internshipModel = new InternshipModel();
                $conversionModel = new \App\Models\ConversionRequestModel();
                $lecturerModel   = new LecturerModel();
                $prodiModel      = new \App\Models\ProgramStudyModel();
                $assignmentModel = new \App\Models\SupervisorAssignmentModel();

                $lecturer = $lecturerModel->where('user_id', $userId)->first();

                // Default aman bila profil Kaprodi (baris lecturers) tidak ditemukan
                $data['prodi']              = null;
                $data['activeCount']        = 0;
                $data['assignedCount']      = 0;
                $data['pendingAssignments'] = 0;
                $data['conversionCount']    = 0;
                $data['queueList']          = [];
                $data['prodiLecturers']     = [];
                $data['recentActivities']   = [];

                if ($lecturer) {
                    $prodiId = $lecturer['program_study_id'];

                    $data['prodi'] = $prodiModel->find($prodiId);

                    // Magang aktif pada prodi kaprodi
                    $data['activeCount'] = $internshipModel->select('internships.id')
                        ->join('students', 'students.id = internships.student_id')
                        ->where('students.program_study_id', $prodiId)
                        ->where('internships.status', 'INTERNSHIP_ACTIVE')
                        ->countAllResults();

                    // Sudah memiliki pembimbing = memiliki penugasan berstatus ACCEPTED
                    $data['assignedCount'] = $assignmentModel->select('supervisor_assignments.id')
                        ->join('internships', 'internships.id = supervisor_assignments.internship_id')
                        ->join('students', 'students.id = internships.student_id')
                        ->where('students.program_study_id', $prodiId)
                        ->where('supervisor_assignments.status', 'ACCEPTED')
                        ->countAllResults();

                    // Menunggu penetapan pembimbing (sudah diverifikasi TU)
                    $data['pendingAssignments'] = $internshipModel->select('internships.id')
                        ->join('students', 'students.id = internships.student_id')
                        ->where('students.program_study_id', $prodiId)
                        ->where('internships.status', 'ADMIN_APPROVED')
                        ->countAllResults();

                    $data['conversionCount'] = count($conversionModel->getRequestsForKaprodi($prodiId));

                    $data['lecturersCount'] = $lecturerModel->join('users', 'users.id = lecturers.user_id')
                        ->where('lecturers.program_study_id', $prodiId)
                        ->whereIn('users.role', ['dosen', 'wadek1'])
                        ->countAllResults();

                    // Antrian penentuan pembimbing
                    $data['queueList'] = $internshipModel->select('internships.id, internships.company_name, internships.internship_type, internships.start_date, internships.end_date, internships.created_at, internships.status, students.nim, users.name as student_name')
                        ->join('students', 'students.id = internships.student_id')
                        ->join('users', 'users.id = students.user_id')
                        ->where('students.program_study_id', $prodiId)
                        ->whereIn('internships.status', ['ADMIN_APPROVED', 'SUPERVISOR_ASSIGNED'])
                        ->orderBy('internships.id', 'DESC')
                        ->findAll();

                    // Beban pembimbing per dosen pada prodi ini
                    $prodiLecturers = $lecturerModel->select('lecturers.id, lecturers.nidn, users.name')
                        ->join('users', 'users.id = lecturers.user_id')
                        ->where('lecturers.program_study_id', $prodiId)
                        ->where('users.is_active', 1)
                        ->whereIn('users.role', ['dosen', 'dosen_pembimbing', 'dosen_mk'])
                        ->orderBy('users.name', 'ASC')
                        ->findAll();

                    // Jumlah mahasiswa bimbing per dosen (hanya penugasan ACCEPTED di prodi ini)
                    $loadCounts = \Config\Database::connect()->table('supervisor_assignments')
                        ->select('supervisor_assignments.lecturer_id, COUNT(*) as student_count')
                        ->join('internships', 'internships.id = supervisor_assignments.internship_id')
                        ->join('students', 'students.id = internships.student_id')
                        ->where('students.program_study_id', $prodiId)
                        ->where('supervisor_assignments.status', 'ACCEPTED')
                        ->groupBy('supervisor_assignments.lecturer_id')
                        ->get()
                        ->getResultArray();

                    $loadMap = array_column($loadCounts, 'student_count', 'lecturer_id');

                    foreach ($prodiLecturers as &$lec) {
                        $count        = (int) ($loadMap[$lec['id']] ?? 0);
                        $lec['student_count'] = $count;
                        $lec['capacity']       = SUPERVISOR_MAX_STUDENTS;
                        $lec['remaining']      = SUPERVISOR_MAX_STUDENTS - $count;
                    }
                    unset($lec);

                    $data['prodiLecturers'] = $prodiLecturers;

                    // Aktivitas akademik terbaru pada prodi ini
                    $data['recentActivities'] = $internshipModel->select('internships.id, internships.company_name, internships.status, internships.updated_at, students.nim, users.name as student_name')
                        ->join('students', 'students.id = internships.student_id')
                        ->join('users', 'users.id = students.user_id')
                        ->where('students.program_study_id', $prodiId)
                        ->orderBy('internships.id', 'DESC')
                        ->findAll(10);
                }

                return view('kaprodi/dashboard', $data);

            case 'dosen':
            case 'dosen_pembimbing':
            case 'dosen_mk':
                $lecturerModel           = new LecturerModel();
                $assignmentModel         = new \App\Models\SupervisorAssignmentModel();
                $courseModel             = new CourseModel();
                $conversionCourseModel   = new \App\Models\ConversionRequestCourseModel();
                $conversionModel         = new \App\Models\ConversionRequestModel();

                // Pastikan active_role terinisialisasi
                $activeRole = session()->get('active_role');
                if (!$activeRole || !in_array($activeRole, ['dosen_pembimbing', 'dosen_mk'])) {
                    $activeRole = 'dosen_pembimbing';
                    session()->set('active_role', $activeRole);
                }
                $data['activeRole'] = $activeRole;

                $lecturer = $lecturerModel->where('user_id', $userId)->first();
                $data['lecturer'] = $lecturer;

                if ($lecturer) {
                    // Data Mahasiswa Bimbingan (Konteks: Dosen Pembimbing)
                    $data['assignments'] = $assignmentModel->select('supervisor_assignments.*, supervisor_assignments.id as assignment_id, supervisor_assignments.status as assignment_status, internships.company_name, internships.position, internships.internship_type, internships.start_date, internships.end_date, internships.status as internship_status, students.nim, users.name as student_name')
                                                          ->join('internships', 'internships.id = supervisor_assignments.internship_id')
                                                          ->join('students', 'students.id = internships.student_id')
                                                          ->join('users', 'users.id = students.user_id')
                                                          ->where('supervisor_assignments.lecturer_id', $lecturer['id'])
                                                          ->orderBy('supervisor_assignments.id', 'DESC')
                                                          ->findAll();
                    $data['pendingAssignmentsCount'] = $assignmentModel->where('lecturer_id', $lecturer['id'])
                                                                       ->where('status', 'PENDING')
                                                                       ->countAllResults();
                    $data['activeStudentsCount']     = $assignmentModel->where('lecturer_id', $lecturer['id'])
                                                                       ->where('status', 'ACCEPTED')
                                                                       ->countAllResults();

                    // Data Mata Kuliah Pengampuan (Konteks: Dosen MK)
                    $data['courses'] = $courseModel->where('lecturer_id', $lecturer['id'])->findAll();

                    // Konversi Stats
                    $lecConversionReqs = $conversionCourseModel->getRequestsForLecturer($lecturer['id']);
                    $data['pendingCourseConversionCount'] = count(array_filter($lecConversionReqs, fn($r) => $r['status'] === 'PENDING'));

                    $spvConversionReqs = $conversionModel->getRequestsForSupervisor($lecturer['id']);
                    $data['pendingSupervisorConversionCount'] = count(array_filter($spvConversionReqs, fn($r) => $r['status'] === 'SUPERVISOR_REVIEW'));

                    // Seminar Stats untuk Dosen MK
                    $seminarModel = new \App\Models\SeminarModel();
                    $candidateSeminars = $seminarModel->getCandidateSeminarsForLecturer($lecturer['id']);
                    $data['candidateSeminarsCount'] = count($candidateSeminars);
                } else {
                    $data['assignments']                      = [];
                    $data['pendingAssignmentsCount']          = 0;
                    $data['activeStudentsCount']              = 0;
                    $data['courses']                          = [];
                    $data['pendingCourseConversionCount']     = 0;
                    $data['pendingSupervisorConversionCount'] = 0;
                    $data['candidateSeminarsCount']           = 0;
                }

                return view('dosen/dashboard', $data);

            case 'wadek1':
                $internshipModel = new InternshipModel();
                $conversionModel = new \App\Models\ConversionRequestModel();
                $data['totalActive'] = $internshipModel->where('status', 'INTERNSHIP_ACTIVE')->countAllResults();
                $data['totalSupervisorAssigned'] = $internshipModel->where('status', 'SUPERVISOR_ASSIGNED')->countAllResults();
                $data['totalAll'] = $internshipModel->countAllResults();
                $data['totalCompleted'] = $internshipModel->whereIn('status', ['INTERNSHIP_COMPLETED', 'COMPLETED'])->countAllResults();
                $data['pendingConversionCount'] = $conversionModel->where('status', 'VICE_DEAN_REVIEW')->countAllResults();

                // 5 Data Magang Aktif Terkini untuk Quick Monitoring (hanya status INTERNSHIP_ACTIVE)
                $data['recentActiveInternships'] = $internshipModel->select('internships.*, students.nim, users.name as student_name, program_studies.name as prodi_name, lecturers_user.name as supervisor_name')
                                                                   ->join('students', 'students.id = internships.student_id')
                                                                   ->join('users', 'users.id = students.user_id')
                                                                   ->join('program_studies', 'program_studies.id = students.program_study_id')
                                                                   ->join('supervisor_assignments', 'supervisor_assignments.internship_id = internships.id', 'left')
                                                                   ->join('lecturers', 'lecturers.id = supervisor_assignments.lecturer_id', 'left')
                                                                   ->join('users as lecturers_user', 'lecturers_user.id = lecturers.user_id', 'left')
                                                                   ->where('internships.status', 'INTERNSHIP_ACTIVE')
                                                                   ->orderBy('internships.id', 'DESC')
                                                                   ->findAll(5);

                return view('wadek1/dashboard', $data);

            case 'admin':
                return redirect()->to('admin/users/kaprodi');

            case 'instansi':
                return redirect()->to('instansi/penilaian');

            default:
                // Role tanpa halaman dashboard khusus (mis. instansi): sediakan nilai aman agar tidak error
                $data['student']          = null;
                $data['internships']      = [];
                $data['activeAssignment'] = null;
                $data['latestInternship'] = null;
                $data['supervisorMap']    = [];
                $data['activeCount']      = 0;
                $data['logbookCount']     = 0;
                $data['conversionCount']  = 0;

                return view('mahasiswa/dashboard', $data);
        }
    }
}
