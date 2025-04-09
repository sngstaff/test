<?php

namespace App\Dto\Configuration;

use App\Dto\DataTransferObject;
use App\UseCase\Traits\DtoTransformTrait;

final class SaveConfigurationDto extends DataTransferObject
{
    use DtoTransformTrait;

    public $id = null;

    public $car_id;

    public $name;
}
