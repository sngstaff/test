<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\ResourcePack\Web\AvailableCarsListPackResource;
use App\Services\CarService;

final class CarController extends Controller
{
    public function __construct(private readonly CarService $carService)
    {
    }

    public function available()
    {
        return response()->json(
            AvailableCarsListPackResource::pack(
                $this->carService->getAvailableCars()
            )
        );
    }
}
