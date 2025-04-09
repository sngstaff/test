<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ControlledException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Car\SaveCarRequest;
use App\Services\CarService;

final class CarController extends Controller
{
    public function __construct(private readonly CarService $carService)
    {
    }

    public function index()
    {
        return response()->json($this->carService->getPaginatedList());
    }

    public function store(SaveCarRequest $request)
    {
        try {
            $this->carService->create($request->validated('name'));

            return jsonResp()->success('Автомобиль успешно добавлен.');
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }

    public function update(SaveCarRequest $request, string $id)
    {
        try {
            $this->carService->updateById($id, $request->validated('name'));

            return jsonResp()->success('Автомобиль успешно обновлен.');
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->carService->deleteById($id);

            return jsonResp()->success('Автомобиль успешно удален.');
        } catch (ControlledException $e) {
            return jsonResp()->error($e->getMessage());
        }
    }
}
