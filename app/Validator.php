<?php

namespace app;

class Validator
{
    const REGISTRATION = 1;

    const LOGIN = 2;

    protected $request;
    
    public function __construct($request)
    {
        $this->request = $request;
    }
    
    public function validate($scenario)
    {
        if ($scenario == static::REGISTRATION) {
            return $this->signUp();
        } elseif ($scenario == static::LOGIN) {
            return $this->signIn();
        }
        return true;
    }

    protected function signUp()
    {
        if (!$this->validateEmail($this->request['email'])) {
            $requestData = new RequestData();
            $requestData->errors[] = 'Не верный формат почты.';
            return $requestData;
        }

        return $this->prepareRequestData('signin');
    }

    protected function signIn()
    {
        return $this->prepareRequestData('signin');
    }

    protected function validateEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }else{
            return false;
        }
    }

    protected function prepareRequestData($action)
    {
        $requestData = new RequestData();
        foreach ($this->request as $key => $value) {
            if ($key === $action) continue;
            $requestData->{$key} = htmlspecialchars(trim($value));
        }

        return $requestData;
    }
}