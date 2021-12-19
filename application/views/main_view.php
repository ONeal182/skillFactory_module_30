
<div class="card mt-5 col-12">
    <h1><?=$data['hello']?></h1>
    <div class="card-header mt-2">
        Список файлов
    </div>
    <div class="row">
        <? if (!empty($data['comments'])) { ?>
            <? foreach ($data['comments'] as $comment) { ?>
                <div class="card col-4" style="width: 18rem;">
                    <img class="card-img-top" src="<?= $comment['file'] ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $comment['name'] ?></h5>
                        <p class="card-text"><?= $comment['comment'] ?></p>
                        <a download href="<?= $comment['file'] ?>" class="btn btn-primary">Скачать файл</a>

                        <form action="/" method="POST">
                            <input type="hidden" name="id_file" value="<?= $comment[0] ?>">
                            <?if($comment['comment'] != null && $data['login'] === true && $data['id_cookie']['id'] == $comment['id']){?>
                                <button type="submit" name="submit_deleted_comment" class="mt-3 btn btn-warning">Удалить комментарий </button>
                            <?}?>
                            <?if($comment['comment'] != null && $data['login'] === true && $data['id_cookie']['id'] == $comment['id']){?>
                            <button type="submit" name="submit_deleted" class="mt-3  btn btn-danger">Удалить файл </button>
                            <?}?>
                            
                        </form>
                    </div>
                </div>

            <? } ?>
        <? } else { ?>
            <h4>Файлов ещё не загрузили</h4>
        <? } ?>
    </div>
</div>

<? if ($data['login'] === true) { ?>
    <div class="container pt-4">
        <h1 class="mb-4">Загрузка файлов</h1>

        <?php if (!empty($data['errors'])) : ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($data['errors'] as $error) : ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($_FILES) && empty($data['errors'])) : ?>
            <div class="alert alert-success">Файлы успешно загружены</div>
        <?php endif; ?>

        <form action="<?php echo URL; ?>" method="post" enctype="multipart/form-data">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="files[]" id="customFile" multiple required>
                <label class="custom-file-label" for="customFile" data-browse="Выбрать">Выберите файлы</label>
                <small class="form-text text-muted">
                    Максимальный размер файла: <?php echo UPLOAD_MAX_SIZE / 1000000; ?>Мб.
                    Допустимые форматы: <?php echo implode(', ', ALLOWED_TYPES) ?>.
                </small>
            </div>

            <hr>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Оставить комментарий</label>
                <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Загрузить</button>
            <a href="<?php echo URL; ?>" class="btn btn-secondary ml-3">Сброс</a>
        </form>
    </div>
<? } ?>