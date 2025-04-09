<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create($arr)
    {
        return $this->model->create($arr);
    }

    // public function where($column, $operator = null, $value = null, $boolean = 'and')
    // {
    //     return $this->model->where($column, $operator, $value, $boolean);
    // }

    // public function findById(int $id)
    // {
    //     return $this->model->whereId($id)->first();
    // }

    public function updateById(int $id, array $array)
    {
        $row = $this->model->findOrFail($id);

        return tap($row, fn ($model) => $model->update($array));
    }

    // public function updateOrCreate(array $attributes, array $values = [])
    // {
    //     $this->model->updateOrCreate($attributes, $values);
    // }

    public function getAll()
    {
        return $this->model->get();
    }

    public function getPaginated(int $perPage = 20)
    {
        return $this->model->paginate($perPage);
    }

    // public function findOrFail(int $id)
    // {
    //     return $this->model->findOrFail($id);
    // }

    public function newQuery()
    {
        return $this->model->newQuery();
    }

    public function deleteWhere(array $where = [], bool $force = false)
    {
        $builder = $this->newQuery()->where($where);

        if ($force) {
            return $builder->forceDelete();
        }

        return $builder->delete();
    }
}
