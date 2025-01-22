<?php

namespace App\Service;

use App\Contracts\ServiceInterface;

abstract class BaseService implements ServiceInterface
{
    protected $repository;

}
