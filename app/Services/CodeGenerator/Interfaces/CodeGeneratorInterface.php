<?php

namespace App\Services\CodeGenerator\Interfaces;

interface CodeGeneratorInterface
{
    public function generateCode(string $email): int;

    public function validateCode(string $email, string $code): bool;
}
