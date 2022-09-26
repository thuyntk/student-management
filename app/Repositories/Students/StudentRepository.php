<?php

namespace App\Repositories\Students;

use App\Models\Student;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

    public function search($data)
    {
        $student = $this->model->newQuery();

        if(isset($data['age_from'])) {
            $student->whereYear('birthday', '<=', Carbon::now()->subYear($data['age_from'])->format('Y'));
        }

        if(isset($data['age_to'])) {
            $student->whereYear('birthday', '>=', Carbon::now()->subYear($data['age_to'])->format('Y'));
        }
        return $student->paginate(10);
    }

    public function whereByUserId($id)
    {
        return $this->model->where('user_id',$id)->first();
    }

    public function getStudentById()
    {
        return $this->model->where('user_id', Auth::id())->first()->id;
    }

}