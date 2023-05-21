<?php
global $cats;
global $conn;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $img = null;
    //Проверяем, было ли загружено изображение
    if(isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        //Получаем информацию о файле
        $file_name = $_FILES['img']['name'];
        $file_tmp = $_FILES['img']['tmp_name'];
        $file_size = $_FILES['img']['size'];
        $file_error = $_FILES['img']['error'];
        $file_type = $_FILES['img']['type'];
        //Проверяем расширение файла
        if($file_type === 'image/jpg' || $file_type === 'image/jpeg' || $file_type === 'image/png') {
            //Задаем путь для сохранения файла
            $target_dir = "D:\Documents\ptu\web\openserver\OSPanel\domains\localhost\otiva\uploads\\";
            $time = time();
            $target_file = $target_dir . $time . basename($file_name);
            //Перемещаем файл в нужную директорию
            if(move_uploaded_file($file_tmp, $target_file)) {
                $img = "/otiva/uploads/". $time . basename($file_name);
            } else {
                echo "Произошла ошибка при сохранении файла.";
            }
        } else {
            echo "Допустимы только файлы JPEG, PNG и JPG.";
        }
    } else {
        echo json_encode($_FILES);
    }

    $stmt = $conn->prepare("call crate_advert (:author, :title, :img, :description, :category, :price)");
    $stmt->bindParam(':author', $_SESSION["user_uid"]);
    $stmt->bindParam(':title', $_POST["title"]);
    $stmt->bindParam(':img', $img);
    $stmt->bindParam(':description', $_POST["desc"]);
    $stmt->bindParam(':category', $_POST["cat"]);
    $stmt->bindParam(':price', $_POST["price"]);

    if ($stmt->execute()) {
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Произошла ошибка при выполнении запроса!";
    }
}

?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Добавление товара</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="recipient-title" class="col-form-label">Прикрепите картинку</label>
                        <input type="file" name="img" accept=".png, .jpg" class="form-control" id="recipient-title">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-title" class="col-form-label">Название</label>
                        <input type="text" required name="title" class="form-control" id="recipient-title">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-desc" class="col-form-label">Описание</label>
                        <textarea class="form-control" name="desc" id="recipient-desc" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-price" class="col-form-label">Цена</label>
                        <input type="number" required name="price" class="form-control" id="recipient-price">
                    </div>
                    <select class="form-select" name="cat">
                        <?php foreach ($cats as $cat): ?>
                            <option
                                <?php if ($cat["cid"] == 1) { echo("selected"); }?>
                                    value="<?php echo($cat["cid"])?>">
                                <?php echo($cat["name"])?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    console.log("i'm here")
</script>