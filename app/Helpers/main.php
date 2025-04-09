<?php

function authUser()
{
    return Illuminate\Support\Facades\Auth::user();
}

function jsonResp()
{
    return \App\UseCase\JsonResponse::init();
}


function isLocal(): bool
{
    return config('app.env') === 'local';
}
