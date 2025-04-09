<?php

namespace App\Dto\Price;

use App\Dto\DataTransferObject;
use App\UseCase\Traits\DtoTransformTrait;

final class SavePriceDto extends DataTransferObject
{
    use DtoTransformTrait;

    public $id = null;

    public $configuration_id;

    public $price;

    public $start_date;

    public $end_date;
}
