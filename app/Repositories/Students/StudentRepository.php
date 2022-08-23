<?php

namespace App\Repositories\Student;

use App\Models\Student;
use App\Repositories\BaseRepository;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Student::class;
    }

    public function newFaculty()
    {
        return new $this->model;
    }

}