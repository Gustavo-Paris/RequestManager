<?php

namespace RequestManager\Interfaces;

interface InterfaceApiDelete
{
    public function delete(string $route = ''): array;
}
