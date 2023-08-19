<?php

namespace RequestManager\Abstracts;

abstract class AbstractJWTAuthenticate
{
    public function authenticate(array $credencials): string
    {
    }
}
