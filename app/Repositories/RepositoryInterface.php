<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function all(int $limit);
    public function search(array $constraints, int $limit);
    public function store(array $data);
    public function modify($id, array $data);
    public function destroy($id);
    public function soft($id, array $data);
    public function workflow($id, array $data);
    public function single($id);
}