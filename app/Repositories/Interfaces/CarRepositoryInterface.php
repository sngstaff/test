<?php

namespace App\Repositories\Interfaces;

/**
 * @see \App\Repositories\CarRepository
 */
interface CarRepositoryInterface extends BaseRepositoryInterface
{
    public function getAvailableCars();
}
