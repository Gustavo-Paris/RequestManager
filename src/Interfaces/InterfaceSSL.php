<?php

namespace RequestManager\Interfaces;

interface InterfaceSSL
{
    /**
     * @return mixed
     */
    public function getSsl();

    /**
     * @param bool $flag
     * @return void
     */
    public function setSsl(bool $flag = false): void;
}
