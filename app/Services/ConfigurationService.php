<?php

namespace App\Services;

use App\Dto\Configuration\SaveConfigurationDto;
use App\Events\ForgetCacheCarsAfterChange;
use App\Models\Configuration;
use App\Repositories\Interfaces\ConfigurationRepositoryInterface;
use App\Traits\Transactionable;
use Illuminate\Pagination\LengthAwarePaginator;

final class ConfigurationService
{
    use Transactionable;

    public function __construct(private readonly ConfigurationRepositoryInterface $configurationRepository)
    {
    }

    public function getPaginatedList(): LengthAwarePaginator
    {
        return $this->configurationRepository->getPaginated();
    }

    public function create(SaveConfigurationDto $dto): Configuration
    {
        return $this->configurationRepository->create($dto->except('id')->toArray());
    }

    public function updateById(SaveConfigurationDto $dto): Configuration
    {
        return $this->transaction(function () use ($dto) {
            event(new ForgetCacheCarsAfterChange());

            return $this->configurationRepository->updateById($dto->id, $dto->except('id')->toArray());
        });
    }

    public function deleteById(int|string $id): bool
    {
        return $this->transaction(function () use ($id) {
            event(new ForgetCacheCarsAfterChange());

            return $this->configurationRepository->deleteWhere(['id' => $id]);
        });
    }
}
