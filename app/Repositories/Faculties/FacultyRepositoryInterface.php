<?php

namespace App\Repositories\Faculties;

use App\Repositories\RepositoryInterface;

interface FacultyRepositoryInterface extends RepositoryInterface
{
    public function newFaculty();
}