<?php

namespace App\Services;

interface UserService
{
    public function all();
    public function show($id);
    public function update($id, array $data);
    public function delete($id);
    public function create(array $data);
}
