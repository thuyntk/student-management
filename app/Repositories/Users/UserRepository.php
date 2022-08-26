<?php

namespace App\Repositories\Users;

use \App\Models\User;
use \App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return User::class;
    }
    public function newUser()
    {
        return new $this->model;
    }  

}