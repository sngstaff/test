<?php

namespace App\Repositories\Interfaces;

/**
 * @see \App\Repositories\BaseRepository
 */
interface BaseRepositoryInterface
{
    public function create($arr);

    // public function firstOrCreate(array $attributes = [], array $values = []);

    // public function where($column, $operator = null, $value = null, $boolean = 'and');

    // public function findById(int $id);

    public function updateById(int $id, array $array);

    // public function updateOrCreate(array $attributes, array $values = []);

    public function getAll();

    public function getPaginated(int $perPage = 20);

    // public function findOrFail(int $id);

    public function newQuery();

    public function deleteWhere(array $where = [], bool $force = false);

    // public function insert($insert);
}
