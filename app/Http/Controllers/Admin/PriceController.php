<?php

namespace App\Http\Controllers\Admin;

use App\Dto\Price\SavePriceDto;
use App\Exceptions\ControlledException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Price\SavePriceRequest;
use App\Repositories\Interfaces\ConfigurationRepositoryInterface;
use App\Services\PriceService;

final class PriceController extends Controller
{
    public function __construct(
        private readonly PriceService $priceService,
        private readonly ConfigurationRepositoryInterface $configurationRepository
    ) {
    }

    public function fetchMeta()
    {
        return response()->json([
            'configurations' => $this->configurationRepository->getAll()->select('id', 'name')
        ]);
    }

    public function index()
    {
        return response()->json($this->priceService->getPaginatedList());
    }


    public function store(SavePriceRequest $request)
    {
        try {
            $this->priceService->create(
                SavePriceDto::transform($request->validated())
            );

            return jsonResp()->success('Опция успешно добавлена.');
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }

    public function update(SavePriceRequest $request, string $id)
    {
        try {
            $this->priceService->updateById(
                SavePriceDto::transform([
                    ...$request->validated(),
                    'id' => $id
                ])
            );

            return jsonResp()->success('Опция успешно обновлена.');
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->priceService->deleteById($id);

            return jsonResp()->success('Опция успешно удалена.');
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }
}
