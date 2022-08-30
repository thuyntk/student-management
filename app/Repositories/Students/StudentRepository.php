<?php

namespace App\Repositories\Students;

use App\Models\Student;
use App\Repositories\BaseRepository;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Student::class;
    }

    public function newStudent()
    {
        return new $this->model;
    }

}