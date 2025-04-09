<?php

namespace App\Http\Controllers\Admin;

use App\Dto\Configuration\SaveConfigurationDto;
use App\Exceptions\ControlledException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Configuration\SaveConfigurationRequest;
use App\Repositories\Interfaces\CarRepositoryInterface;
use App\Services\ConfigurationService;

final class ConfigurationController extends Controller
{
    public function __construct(
        private readonly ConfigurationService $configurationService,
        private readonly CarRepositoryInterface $carRepository
    ) {
    }

    public function fetchMeta()
    {
        return response()->json([
            'cars' => $this->carRepository->getAll()->select('id', 'name')
        ]);
    }

    public function index()
    {
        return response()->json($this->configurationService->getPaginatedList());
    }

    public function store(SaveConfigurationRequest $request)
    {
        try {
            $this->configurationService->create(
                SaveConfigurationDto::transform($request->validated())
            );

            return jsonResp()->success('Конфигурация успешно добавлена.');
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }

    public function update(SaveConfigurationRequest $request, string $id)
    {
        try {
            $this->configurationService->updateById(
                SaveConfigurationDto::transform([
                    ...$request->validated(),
                    'id' => $id
                ])
            );

            return jsonResp()->success('Конфигурация успешно обновлена.');
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->configurationService->deleteById($id);

            return jsonResp()->success('Конфигурация успешно удалена.');
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }
}
