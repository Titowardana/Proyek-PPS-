<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStudentJustificationToConversionRequestCoursesTable extends Migration
{
    public function up()
    {
        if ($this->db->fieldExists('student_justification', 'conversion_request_courses')) {
            return;
        }

        $fields = [
            'student_justification' => [
                'type'  => 'TEXT',
                'null'  => true,
                'after' => 'course_id',
            ],
        ];
        $this->forge->addColumn('conversion_request_courses', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('conversion_request_courses', 'student_justification');
    }
}
