<?php

namespace App\Services;

use App\Events\ForgetCacheCarsAfterChange;
use App\Models\Option;
use App\Repositories\Interfaces\OptionRepositoryInterface;
use App\Traits\Transactionable;
use Illuminate\Pagination\LengthAwarePaginator;

final class OptionService
{
    use Transactionable;

    public function __construct(private readonly OptionRepositoryInterface $optionRepository)
    {
    }

    public function getPaginatedList(): LengthAwarePaginator
    {
        return $this->optionRepository->getPaginated();
    }

    public function create(string $name): Option
    {
        return $this->optionRepository->create(['name' => $name]);
    }

    public function updateById(int|string $id, string $name): Option
    {
        return $this->transaction(function () use ($id, $name) {
            event(new ForgetCacheCarsAfterChange());

            return $this->optionRepository->updateById($id, ['name' => $name]);
        });
    }

    public function deleteById(int|string $id): bool
    {
        return $this->transaction(function () use ($id) {
            event(new ForgetCacheCarsAfterChange());

            return $this->optionRepository->deleteWhere(['id' => $id]);
        });
    }
}
