<?php

namespace interface;

interface CRUDInterface{
    public function create(array $data, \Database $db): bool;
    public function update(array $data, int $id, \Database $db): bool;
    public function delete(int $id, \Database $db): bool;
    public function readAll(\Database $db): array;

}
