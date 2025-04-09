<?php

namespace App\Dto;

use Illuminate\Support\Collection;

abstract class DataTransferObject
{
    public function __construct(array $parameters = [])
    {
        $class = new \ReflectionClass(static::class);

        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $reflectionProperty) {
            $property = $reflectionProperty->getName();

            if (key_exists($property, $parameters)) {
                $this->{$property} = $parameters[$property];
            }
        }
    }

    public function toArray(): array
    {
        $props = [];
        $class = new \ReflectionClass(static::class);

        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $reflectionProperty) {
            $property = $reflectionProperty->getName();
            $props[$property] = $reflectionProperty->getValue($this);
        }

        return $props;
    }

    public function except($keys): Collection
    {
        return collect($this->toArray())->except($keys);
    }

    public function toCollect(): Collection
    {
        return collect($this->toArray());
    }

    public function toJson()
    {
        return collect($this->toArray())->toJson();
    }

    public function toObject(): object
    {
        return (object) $this->toArray();
    }

    public function setField($field, $value): void
    {
        $this->{$field} = $value;
    }
}
