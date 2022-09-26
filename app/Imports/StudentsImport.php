<?php

namespace App\Imports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $subject = Subject::with('student')->whereHas('student', function ($q) {
            $q->where('subject_id', $this->id);
        })->get();
        $data = ['1'];

        foreach($subject[0]->students as $student) {
            if ($student->id == $row['id']) {
                $data[] = [
                    'id' => $row['0'],
                    'name' => $row['1'],
                    'point' => $row['2']

                ];
            }
        }
    }
}
