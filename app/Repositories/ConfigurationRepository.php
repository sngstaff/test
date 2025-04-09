<?php

namespace App\Repositories;

use App\Models\Configuration;
use App\Repositories\Interfaces\ConfigurationRepositoryInterface;

class ConfigurationRepository extends BaseRepository implements ConfigurationRepositoryInterface
{
    public function __construct(Configuration $model)
    {
        parent::__construct($model);
    }
}
