<?php

namespace App\Services;

use App\Dto\Price\SavePriceDto;
use App\Events\ForgetCacheCarsAfterChange;
use App\Models\Price;
use App\Repositories\Interfaces\PriceRepositoryInterface;
use App\Traits\Transactionable;
use Illuminate\Pagination\LengthAwarePaginator;

final class PriceService
{
    use Transactionable;

    public function __construct(private readonly PriceRepositoryInterface $priceRepository)
    {
    }

    public function getPaginatedList(): LengthAwarePaginator
    {
        return $this->priceRepository->getPaginated();
    }

    public function create(SavePriceDto $dto): Price
    {
        return $this->transaction(function () use ($dto) {
            event(new ForgetCacheCarsAfterChange());

            return $this->priceRepository->create($dto->except('id')->toArray());
        });
    }

    public function updateById(SavePriceDto $dto): Price
    {
        return $this->transaction(function () use ($dto) {
            event(new ForgetCacheCarsAfterChange());

            return $this->priceRepository->updateById($dto->id, $dto->except('id')->toArray());
        });
    }

    public function deleteById(int|string $id): bool
    {
        return $this->transaction(function () use ($id) {
            event(new ForgetCacheCarsAfterChange());

            return $this->priceRepository->deleteWhere(['id' => $id]);
        });
    }
}
