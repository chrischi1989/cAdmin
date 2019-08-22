<?php

namespace psnXT\Traits;

trait Tenant
{
    public function __construct(array $attributes = [])
    {
        $this->setConnection(session('connection', 'mysql'));

        parent::__construct($attributes);
    }
}
