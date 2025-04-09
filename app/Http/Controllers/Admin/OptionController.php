<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ControlledException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Option\SaveOptionRequest;
use App\Services\OptionService;

final class OptionController extends Controller
{
    public function __construct(private readonly OptionService $optionService)
    {
    }

    public function index()
    {
        return response()->json($this->optionService->getPaginatedList());
    }


    public function store(SaveOptionRequest $request)
    {
        try {
            $this->optionService->create($request->validated('name'));

            return jsonResp()->success('Опция успешно добавлена.');
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }

    public function update(SaveOptionRequest $request, string $id)
    {
        try {
            $this->optionService->updateById($id, $request->validated('name'));

            return jsonResp()->success('Опция успешно обновлена.');
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->optionService->deleteById($id);

            return jsonResp()->success('Опция успешно удалена.');
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }
}
