<?php

namespace App\Repositories\Students;

use App\Repositories\RepositoryInterface;

interface StudentRepositoryInterface extends RepositoryInterface
{
    public function newFaculty();
}