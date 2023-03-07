<?
require_once 'connect.php';
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['is_admin'] === 1) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once 'upload.php';
            $photo = uploadImage();
            if ($photo !== null) {
                $stmt = $connect->prepare("INSERT INTO dishes (name, price, category, photo, ingredients, country, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$_POST['name'], $_POST['price'], $_POST['category'], $photo, $_POST['ingredients'], $_POST['country'], $_POST['quantity']]);
            }
            header('Location: menu.php');
            die();
        }
?>
        <? require_once 'top.php'; ?>
        <div class="row justify-content-center">
            <div class="col col-lg-6">
                <div class="fs-3 text-center mb-2">Добавить блюдо</div>
                <form action="add_dish.php" method="POST" enctype="multipart/form-data">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <input type="text" name="name" id="floatingName" class="form-control" placeholder="Наименование" required>
                                <label for="floatingName">Наименование</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="price" id="floatingPrice" class="form-control" placeholder="Цена" required>
                                <label for="floatingPrice">Цена</label>
                            </div>
                            <div class="mb-3">
                                <label for="floatingIngr" class="mx-2">Фото</label>
                                <input type="file" accept=".jpeg,.jpg,.png" name="photo" class="form-control" placeholder="Фото" required>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="category" required id="floatingCateg">
                                    <?
                                    $categories = $connect->query("SELECT * FROM categories")->fetchAll();
                                    foreach ($categories as $category) {
                                    ?>
                                        <option value="<?= $category["id"] ?>"><?= $category["name"] ?></option>
                                    <?
                                    }
                                    ?>
                                </select>
                                <label for="floatingCateg">Категории</label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea type="text" name="ingredients" id="floatingIngr" class="form-control" placeholder="Состав" required></textarea>
                                <label for="floatingIngr">Состав</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="country" id="floatingCountry" class="form-control" placeholder="Страна" required>
                                <label for="floatingCountry">Страна</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="quantity" id="floatingQuantity" class="form-control" placeholder="Количество" required>
                                <label for="floatingQuantity">Количество</label>
                            </div>
                            <div>
                                <input type="submit" class="btn btn-primary w-100" value="Добавить">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <? require_once 'bottom.php'; ?>
<?
    } else {
        die("Это страница только для админа");
    }
}

?>