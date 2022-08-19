<?php

namespace App\Repositories\Subject;

use \App\Models\Subject;
use \App\Repositories\BaseRepository;

class SubjectsRepository extends BaseRepository implements SubjectsRepositoryInterface
{
    public function getModel()
    {
        return Subject::class;
    }
    public function newSubject()
    {
        return new $this->model;
    }
    // public function getAll()
    // {
    //     return $this->model->paginate(15);
    // }
  

}