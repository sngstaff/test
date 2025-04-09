<?php

namespace App\Services;

use App\Dto\ConfigurationOption\SaveConfigurationOptionDto;
use App\Events\ForgetCacheCarsAfterChange;
use App\Models\ConfigurationOption;
use App\Repositories\Interfaces\ConfigurationOptionRepositoryInterface;
use App\Traits\Transactionable;
use Illuminate\Pagination\LengthAwarePaginator;

final class ConfigurationOptionService
{
    use Transactionable;

    public function __construct(private readonly ConfigurationOptionRepositoryInterface $configOptionRepository)
    {
    }

    public function getPaginatedList(): LengthAwarePaginator
    {
        return $this->configOptionRepository->getPaginated();
    }

    public function create(SaveConfigurationOptionDto $dto): ConfigurationOption
    {
        return $this->configOptionRepository->create($dto->except('id')->toArray());
    }

    public function updateById(SaveConfigurationOptionDto $dto): ConfigurationOption
    {
        return $this->transaction(function () use ($dto) {
            event(new ForgetCacheCarsAfterChange());

            return $this->configOptionRepository->updateById($dto->id, $dto->except('id')->toArray());
        });
    }

    public function deleteById(int|string $id): bool
    {
        return $this->transaction(function () use ($id) {
            event(new ForgetCacheCarsAfterChange());

            return $this->configOptionRepository->deleteWhere(['id' => $id]);
        });
    }
}
