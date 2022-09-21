<?php

namespace App\Repositories\Subjects;

use \App\Models\Subject;
use \App\Repositories\BaseRepository;

class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
{
    public function getModel()
    {
        return Subject::class;
    }
    
    public function newSubject()
    {
        return new $this->model;
    }

    public function count($arrs = [])
    {
        return  $this->model->count($arrs);
    }
    // public function getAll()
    // {
    //     return $this->model->paginate(15);
    // }
  

}