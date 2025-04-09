<?php

namespace App\Services\CodeGenerator;

use App\Services\CacheManager\CacheManagerService;
use App\Services\CodeGenerator\Interfaces\CodeGeneratorInterface;

final class VerificationCodeGenerator implements CodeGeneratorInterface
{
    public function __construct(private readonly CacheManagerService $cacheManager)
    {
    }

    public function generateCode(string $email): int
    {
        $code = rand(1111, 9999);

        $this->cacheManager->put($this->getKey($email), $code, 5);

        return $code;
    }

    public function validateCode(string $email, string $code): bool
    {
        if (isLocal() && $code === '1111') {
            return true;
        }

        return $this->cacheManager->get($this->getKey($email)) === $code;
    }

    private function getKey(string $email): string
    {
        return "verification.$email";
    }
}
