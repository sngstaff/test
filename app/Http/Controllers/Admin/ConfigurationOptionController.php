<?php

namespace App\Http\Controllers\Admin;

use App\Dto\ConfigurationOption\SaveConfigurationOptionDto;
use App\Exceptions\ControlledException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ConfigurationOption\SaveConfigurationOptionRequest;
use App\Repositories\Interfaces\ConfigurationRepositoryInterface;
use App\Repositories\Interfaces\OptionRepositoryInterface;
use App\Services\ConfigurationOptionService;

final class ConfigurationOptionController extends Controller
{
    public function __construct(
        private readonly ConfigurationOptionService $configOptionService,
        private readonly ConfigurationRepositoryInterface $configurationRepository,
        private readonly OptionRepositoryInterface $optionRepository,
    ) {
    }

    public function fetchMeta()
    {
        return response()->json([
            'configurations' => $this->configurationRepository->getAll()->select('id', 'name'),
            'options' => $this->optionRepository->getAll()->select('id', 'name'),
        ]);
    }

    public function index()
    {
        return response()->json($this->configOptionService->getPaginatedList());
    }

    public function store(SaveConfigurationOptionRequest $request)
    {
        try {
            $this->configOptionService->create(
                SaveConfigurationOptionDto::transform($request->validated())
            );

            return jsonResp()->success('Данные успешно добавлены.');
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }

    public function update(SaveConfigurationOptionRequest $request, string $id)
    {
        try {
            $this->configOptionService->updateById(
                SaveConfigurationOptionDto::transform([
                    ...$request->validated(),
                    'id' => $id
                ])
            );

            return jsonResp()->success('Данные успешно обновлены.');
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->configOptionService->deleteById($id);

            return jsonResp()->success('Данные успешно удалены.');
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }
}
