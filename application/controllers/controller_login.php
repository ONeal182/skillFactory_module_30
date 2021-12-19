<?php

class Controller_Login extends Controller
{
    function __construct()
    {
        $this->model_user = new Model_Login();
        $this->view = new View();
        $this->model = new Model();
    }
    function generateCode($length = 6)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0, $clen)];
        }
        return $code;
    }
    function action_index()
    {
        // $data_test = ['name' => 'ONeal', 'email' => 'kigat64@mail.ru', 'password' => '123'];
        // $this->model_user->update($data_test);

        $link = $this->model->get_connection();
        $email = $_POST['email'];

        if (isset($_POST['submit'])) {
            // Вытаскиваем из БД запись, у которой логин равняется введенному
            $data =  $this->model_user->getUserByEmail($email);
            // Сравниваем пароли
            if (password_verify($_POST['password'], $data['password'])) {
                // Генерируем случайное число и шифруем его
                $hash = md5($this->generateCode(10));

                if (!empty($_POST['not_attach_ip'])) {
                    // Если пользователя выбрал привязку к IP
                    // Переводим IP в строку
                    $insip = ", user_ip=INET_ATON('" . $_SERVER['REMOTE_ADDR'] . "')";
                }
                // Записываем в БД новый хеш авторизации и IP
                $this->model_user->updateHash($data, $hash, $insip);

                // Ставим куки
                setcookie("id", $data['id'], time() + 60 * 60 * 24 * 30, "/");
                setcookie("hash", $hash, time() + 60 * 60 * 24 * 30, "/", null, null, true); // httponly !!! 
                // Переадресовываем браузер на страницу проверки нашего скрипта
                header('HTTP/1.1 301 Moved Permanently');
                header('Location: /');
                echo 'Отлично!';
                
                exit();
            } else {
                print "Вы ввели неправильный логин/пароль";
            }
        }
    }
}
