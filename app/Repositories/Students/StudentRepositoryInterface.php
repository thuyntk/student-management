<?php

namespace App\Repositories\Students;

use App\Repositories\RepositoryInterface;

interface StudentRepositoryInterface extends RepositoryInterface
{
    public function newStudent();
    
    public function search($data);

    public function whereByUserId($id);

    public function getStudentById();

}