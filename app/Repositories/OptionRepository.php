<?php

namespace App\Repositories;

use App\Models\Option;
use App\Repositories\Interfaces\OptionRepositoryInterface;

class OptionRepository extends BaseRepository implements OptionRepositoryInterface
{
    public function __construct(Option $model)
    {
        parent::__construct($model);
    }
}
