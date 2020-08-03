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
            return $this->signUp();
        }
        return true;
    }

    protected function signUp()
    {
        $requestData = new RequestData();
        if (!$this->validateEmail($this->request['email'])) {
            $requestData->errors[] = 'Не верный формат почты.';
            return $requestData;
        }
        foreach ($this->request as $key => $value) {
            if ($key === 'signup') continue;
            $requestData->{$key} = htmlspecialchars(trim($value));
        }
//        echo '<pre>'; print_r($requestData); die;
        return $requestData;

    }

    protected function validateEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }else{
            return false;
        }
    }
}