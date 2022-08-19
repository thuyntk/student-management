<?php 

namespace App\Repositories\Subject;

use App\Repositories\RepositoryInterface;

interface SubjectsRepositoryInterface extends RepositoryInterface
{
    public function newSubject();
}