<?php

class Controller_File extends Controller
{
    function __construct()
    {
        $this->model_file = new Model_File();
        $this->view = new View();
        $this->model = new Model();
    }

    function action_index()
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
            $data['name'] = $this->model_file->getUserById($data['user_id'])['name'];
            $data['comment'] = $_POST['comment'];
            $data['file'] = $filePath;
            $data['created_at'] = (new DateTime())->format('Y-m-d H:i:s');
            $this->model_file->insert($data);
        }
    }
}
