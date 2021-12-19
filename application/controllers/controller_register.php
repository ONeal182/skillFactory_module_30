<?php

class Controller_Register extends Controller
{
    function __construct()
    {
        $this->model_user = new model_register();
        $this->view = new View();
    }

    function register(array $data)
    {
        $values = [
            $data['name'],
            $data['email'],
            password_hash($data['password'], PASSWORD_ARGON2ID),
            (new DateTime())->format('Y-m-d H:i:s')
        ];
        return $this->model_user->insert($values);
    }
    function isEmailAlreadyExists(string $email)
    {
        if ( $this->model_user->getUserByEmail($email)) {
            return true;
        }
        return false;
    }
    function validate(array $request)
    {
        $errors = [];
        if (!isset($request['email']) || strlen($request['email']) == 0) {
            $errors[]['email'] = 'Email не указан';
        } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[]['email'] = 'Неправильный формат email';
        } elseif (strlen($request['email']) < 4) {
            $errors[]['email'] = 'Email должен быть больше 4х символов';
        } elseif ($this->isEmailAlreadyExists($request['email'])) {
            $errors[]['email'] = 'Email уже используется';
        }
        if (!isset($request['name']) || empty($request['name'])) {
            $errors[]['name'] = 'Имя не указано';
        }
        if (!isset($request['password']) || empty($request['password'])) {
            $errors[]['password'] = 'Пароль не указан';
        }
        if (!isset($request['repeat-password']) || empty($request['repeat-password'])) {

            $errors[]['repeat-password'] = 'Нужно повторить пароль';
        } elseif ((isset($request['password']) && isset($request['repeat-password'])) && ($request['password'] != $request['repeat-password'])) {

            $errors[]['repeat-password'] = 'Пароли не совпадают';
        }
        return $errors;
    }
    function action_index()
    {
        if($_POST){
            echo 'Да';
        }else{
            echo 'Нет';
        }
        $data = $_POST;
        $validate = $this->validate($data);
        if(empty($validate)){
            $this->register($data);
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: /');
            return 'Регистрация успешно завершенна';
        }else{
            return $validate;
        }
        
    }
}
