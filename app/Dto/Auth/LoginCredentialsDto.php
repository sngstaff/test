<?php

namespace App\Dto\Auth;

use App\Dto\DataTransferObject;
use App\UseCase\Traits\DtoTransformTrait;

final class LoginCredentialsDto extends DataTransferObject
{
    use DtoTransformTrait;

    public $email;

    public $code = null;

    public $password = null;

    public $gate = null;
}
