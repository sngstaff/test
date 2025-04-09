<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait Transactionable
{
    protected function beginTransaction(): void
    {
        DB::beginTransaction();
    }

    protected function commit(): void
    {
        DB::commit();
    }

    protected function rollback(): void
    {
        DB::rollback();
    }

    protected function transaction(callable $callback, $attempts = 1)
    {
        return DB::transaction($callback, $attempts);
    }
}
