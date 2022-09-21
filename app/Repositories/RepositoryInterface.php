<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Get's a faculty by it's ID
     *
     * @param int
     */
    public function getAll();

    /**
     * Get's all facultys.
     *
     * @return mixed
     */
    public function find($id);

    public function getLatestRecord();

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);
    
    public function newModel();
    
    public function query();
}