<?php

namespace App\UseCase;

final class JsonResponse
{
    private $code = 200;

    public static function init()
    {
        return new self();
    }

    public function success($message = '', $code = 200)
    {
        $this->code = $code;

        return $this->resp($message, true);
    }

    public function error($message = '', $code = 400)
    {
        $this->code = $code;

        return $this->resp($message, false);
    }

    private function resp($message = '', $status = 200)
    {
        $arr  = is_array($message) ? $message : [];

        $data = array_merge([
            'status'  => $status,
            'message' => !is_array($message) ? $message : ''
        ], $arr);

        return response()->json($data, $this->code);
    }
}
