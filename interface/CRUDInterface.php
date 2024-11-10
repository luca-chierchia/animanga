<?php

namespace interface;

interface CRUDInterface{
    public function create(array $data): bool;
    public function update(array $data, int $id): bool;
    public function delete( int $id): bool;
    public function readAll(): array;

}
