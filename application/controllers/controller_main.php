<?php
class Controller_Main extends Controller
{
    function __construct()
    {
        $this->model = new Model_Main();
        $this->view = new View();
    }
    function deletedFile($user_id)
    {

        $data['id'] = $_POST['id_file'];
        $data['user_id'] = $user_id['id'];
        $this->model->delete($data);
    }
    function deletedComment($user_id){
        $data['id'] = $_POST['id_file'];
        $data['user_id'] = $user_id['id'];
        $this->model->deleteComment($data);//submit_deleted_comment
    }
    function upload()
    {

        $errors = [];
        if (!empty($_FILES)) {

            for ($i = 0; $i < count($_FILES['files']['name']); $i++) {

                $fileName = $_FILES['files']['name'][$i];

                if ($_FILES['files']['size'][$i] > UPLOAD_MAX_SIZE) {
                    $errors[] = 'Недопустимый размер файла ' . $fileName;
                    continue;
                }

                if (!in_array($_FILES['files']['type'][$i], ALLOWED_TYPES)) {
                    $errors[] = 'Недопустимый формат файла ' . $fileName;
                    continue;
                }

                $filePath = UPLOAD_DIR . '/' . basename($fileName);

                if (!move_uploaded_file($_FILES['files']['tmp_name'][$i], $filePath)) {
                    $errors[] = 'Ошибка загрузки файла ' . $fileName;
                    continue;
                }
            }
        }
        if (empty($errors)) {

            $data['user_id'] = (int)$_COOKIE['id'];
            $data['name'] = $this->model->getUserById($data['user_id'])['name'];
            $data['comment'] = $_POST['comment'];
            $data['file'] = $filePath;
            $data['created_at'] = (new DateTime())->format('Y-m-d H:i:s');
            $this->model->insert($data);
        }
        return $errors;
    }
    function action_index()
    {
        $cookie_id = ['id' => $_COOKIE['id']];





        if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {

            $userdata = $this->model->selectUser($cookie_id);

            if (($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['id'] !== $_COOKIE['id'])

            ) {
                setcookie("id", "", time() - 3600 * 24 * 30 * 12, "/");
                setcookie("hash", "", time() - 3600 * 24 * 30 * 12, "/", null, null, true); // httponly !!!
                print "Хм, что-то не получилось";
            } else {
                $data['hello'] = "Привет, " . $userdata['name'] . ". Всё работает!";
                $data['login'] = true;
            }
        } else {
            $data['login'] = false;
        }
        if ($data['login']) {
            $errors = $this->upload();
        }
        if ($data['login'] && isset($_POST['id_file']) && isset($_POST['submit_deleted'])) {
            $this->deletedFile($cookie_id);
        }
        if($data['login'] && isset($_POST['id_file']) && isset($_POST['submit_deleted_comment'])){
            $this->deletedComment($cookie_id);
        }
        $data['errors']= $errors;
        $data['comments'] = $this->model->getComment();
        $data['id_cookie'] = $cookie_id;
        $this->view->generate('main_view.php', 'template_view.php', $data);
    }
}
