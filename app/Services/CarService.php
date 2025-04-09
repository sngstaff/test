<?php

namespace App\Services;

use App\Events\ForgetCacheCarsAfterChange;
use App\Models\Car;
use App\Repositories\Interfaces\CarRepositoryInterface;
use App\Services\CacheManager\CacheManagerService;
use App\Traits\Transactionable;
use Illuminate\Pagination\LengthAwarePaginator;

final class CarService
{
    use Transactionable;

    public function __construct(
        private readonly CarRepositoryInterface $carRepository,
        private readonly CacheManagerService $cacheManager
    ) {
    }

    public function getPaginatedList(): LengthAwarePaginator
    {
        return $this->carRepository->getPaginated();
    }

    public function create(string $name): Car
    {
        return $this->carRepository->create(['name' => $name]);
    }

    public function updateById(int|string $id, string $name): Car
    {
        return $this->transaction(function () use ($id, $name) {
            event(new ForgetCacheCarsAfterChange());

            return $this->carRepository->updateById($id, ['name' => $name]);
        });
    }

    public function deleteById(int|string $id): bool
    {
        return $this->transaction(function () use ($id) {
            event(new ForgetCacheCarsAfterChange());

            return $this->carRepository->deleteWhere(['id' => $id]);
        });
    }

    public function getAvailableCars()
    {
        return $this->cacheManager->getOrRemember(
            'cars.list',
            10,
            fn () => $this->carRepository->getAvailableCars()
        );
    }
}
