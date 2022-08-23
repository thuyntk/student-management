<?php
namespace App\Repositories\Faculties;

use App\Models\Faculty;
use App\Repositories\BaseRepository;


class FacultyRepository extends BaseRepository implements FacultyRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Faculty::class;
    }

    public function newFaculty()
    {
        return new $this->model;
    }
    
    // public function getAll()
    // {
    //     return $this->model->paginate(15);
    // }
  

}