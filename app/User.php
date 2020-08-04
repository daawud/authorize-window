<?php

namespace app;

use PDO;

class User
{
    public $errors;

    protected $attributes;

    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function signUp(RequestData $attributes): User
    {
        $login = $attributes->login;
        $email = $attributes->email;
        if (!$this->isUnique('login', $login)) {
            $this->errors[] = 'Пользователь с таким логином уже существует.';
            return $this;
        }
        if (!$this->isUnique('email', $email)) {
            $this->errors[] = 'Пользователь с таким email уже существует.';
            return $this;
        }
        if ($this->add($attributes)) {
            $authUser = $this->getUserByAttribute('email', $email);
            $this->id = $authUser['id'];
            return $this;
        }
        $this->errors[] = 'Не удалось зарегистрировать пользователя.';
        return $this;
    }

    public function signIn(RequestData $attributes): User
    {
        $userAttributes = $this->getUserByAttribute('login', $attributes->login);
        if (!$userAttributes) {
            $this->errors[] = 'Пользователь с таким логином не найден.';
            return $this;
        }
        if (!password_verify($attributes-> password, $userAttributes['password'])) {
            $this->errors[] = 'Неверный пароль.';
            return $this;
        }

        return $this->fillAttributes($userAttributes);
    }

    public function getUserById($id): User
    {
        $userAttributes = $this->getUserByAttribute('id', $id);

        return $this->fillAttributes($userAttributes);
    }

    protected function fillAttributes($attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
        }

        return $this;
    }

    protected function getUserByAttribute($attr, $value)
    {
        $preparedSql = $this->db->prepare("SELECT * FROM users WHERE " . $attr . "= :" . $attr);
        $preparedSql->bindParam(':' . $attr, $value);
        $preparedSql->execute();

        return $preparedSql->fetch(PDO::FETCH_ASSOC);
    }

    protected function isUnique($attr, $value)
    {
        $qResult = $this->getUserByAttribute($attr, $value);
        if ($qResult) {
            return false;
        }

        return true;
    }

    protected function add($attributes)
    {
        $name = $attributes->name;
        $lastname = $attributes->lastname;
        $middlename = $attributes->middlename;
        $email = $attributes->email;
        $login = $attributes->login;
        $password = password_hash($attributes->password, PASSWORD_DEFAULT);
        $preparedSql = DB::getInstance()
            ->prepare("INSERT INTO users(`name`, lastname, middlename, email, login, password) VALUES(:name, :lastname, :middlename, :email, :login, :password)");
        $preparedSql->bindParam(':name', $name);
        $preparedSql->bindParam(':lastname', $lastname);
        $preparedSql->bindParam(':middlename', $middlename);
        $preparedSql->bindParam(':email', $email);
        $preparedSql->bindParam(':login', $login);
        $preparedSql->bindParam(':password', $password);

        return $preparedSql->execute();
    }
}