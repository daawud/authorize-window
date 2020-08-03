<?php

namespace app;

class Validator
{
    const REGISTRATION = 1;
    
    protected $request;
    
    public function __construct($request)
    {
        $this->request = $request;
    }
    
    public function validate($scenario)
    {
        if ($scenario == static::REGISTRATION) {
            if (isset($this->request[''])) {
                return true;
            }
        }
        return true;
    }
}