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
                $upd = $connect->prepare("UPDATE dishes SET name = ?, price = ?, photo = ?, category = ?, ingredients = ?, country = ?, quantity = ? WHERE id = ?");
                $upd->execute([$_POST['name'], $_POST['price'], $photo, $_POST['category'], $_POST['ingredients'], $_POST['country'], $_POST['quantity'], $_GET["id"]]);
                $upd = $upd->fetch();
            } else {
                $upd = $connect->prepare("UPDATE dishes SET name = ?, price = ?, category = ?, ingredients = ?, country = ?, quantity = ? WHERE id = ?");
                $upd->execute([$_POST['name'], $_POST['price'], $_POST['category'], $_POST['ingredients'], $_POST['country'], $_POST['quantity'], $_GET["id"]]);
                $upd = $upd->fetch();
            }

            header('Location: menu.php');
            die();
        }
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            $stmt = $connect->prepare(
                "SELECT
            dishes.id,
            dishes.name,
            dishes.price,
            dishes.photo,
            dishes.category,
            dishes.ingredients,
            dishes.country,
            dishes.quantity,
            categories.id,
            categories.name AS category_name
        FROM
            dishes
            INNER JOIN categories ON dishes.category = categories.id
        WHERE
            dishes.id = ?"
            );
            $stmt->execute([$_GET["id"]]);
            $stmt = $stmt->fetch();

            require_once 'top.php';
?>
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="fs-3 text-center mb-2">Редактировать блюдо</div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" id="floatingName" class="form-control" placeholder="Наименование" value="<?= $stmt["name"] ?>" required>
                                    <label for="floatingName">Наименование</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="price" id="floatingPrice" class="form-control" placeholder="Цена" value="<?= $stmt["price"] ?>" required>
                                    <label for="floatingPrice">Цена</label>
                                </div>
                                <div class="mb-3">
                                    <label for="floatingIngr" class="mx-2">Фото на данный момент <a href="../uploads/<?= $stmt["photo"] ?>"><?= $stmt["photo"] ?></a></label>
                                    <input type="file" accept=".jpeg,.jpg,.png" name="photo" class="form-control" placeholder="Фото">
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" name="category" required id="floatingCateg">
                                        <?
                                        $categories = $connect->query("SELECT categories.id, categories.name FROM categories")->fetchAll();
                                        foreach ($categories as $category) {
                                        ?>
                                            <option value="<?= $category["id"] ?>" <? if ($category["name"] == $stmt["category_name"]) { ?> selected <? } ?>><?= $category["name"] ?></option>
                                        <?
                                        }
                                        ?>
                                    </select>
                                    <label for="floatingCateg">Категории</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea type="text" name="ingredients" id="floatingIngr" class="form-control" placeholder="Состав" required><?= $stmt["ingredients"] ?></textarea>
                                    <label for="floatingIngr">Состав</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="country" id="floatingCountry" class="form-control" placeholder="Страна" value="<?= $stmt["country"] ?>" required>
                                    <label for="floatingCountry">Страна</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="quantity" id="floatingQuantity" class="form-control" placeholder="Количество" value="<?= $stmt["quantity"] ?>" required>
                                    <label for="floatingQuantity">Количество</label>
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-primary w-100" value="Изменить">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <? } ?>
        <? require_once 'bottom.php' ?>
<?
    } else {
        die("Это страница только для админа");
    }
}

?>