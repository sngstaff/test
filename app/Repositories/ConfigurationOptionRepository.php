<?php

namespace App\Repositories;

use App\Models\ConfigurationOption;
use App\Repositories\Interfaces\ConfigurationOptionRepositoryInterface;

class ConfigurationOptionRepository extends BaseRepository implements ConfigurationOptionRepositoryInterface
{
    public function __construct(ConfigurationOption $model)
    {
        parent::__construct($model);
    }
}
