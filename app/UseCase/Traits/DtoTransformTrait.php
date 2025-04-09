<?php

namespace App\UseCase\Traits;

trait DtoTransformTrait
{
    public static function transform(array $params): self
    {
        foreach ($params as $key => $value) {
            $params[$key] = $value;
        }

        return new self($params);
    }
}
