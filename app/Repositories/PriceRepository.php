<?php

namespace App\Repositories;

use App\Models\Price;
use App\Repositories\Interfaces\PriceRepositoryInterface;

class PriceRepository extends BaseRepository implements PriceRepositoryInterface
{
    public function __construct(Price $model)
    {
        parent::__construct($model);
    }
}
