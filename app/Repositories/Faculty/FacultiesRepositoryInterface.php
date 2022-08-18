<?php

namespace App\Repositories\Faculty;

use App\Repositories\RepositoryInterface;

interface FacultiesRepositoryInterface extends RepositoryInterface
{
    public function newFaculty();
}