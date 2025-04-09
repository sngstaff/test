<?php

namespace App\Dto\ConfigurationOption;

use App\Dto\DataTransferObject;
use App\UseCase\Traits\DtoTransformTrait;

final class SaveConfigurationOptionDto extends DataTransferObject
{
    use DtoTransformTrait;

    public $id = null;

    public $configuration_id;

    public $option_id;
}
