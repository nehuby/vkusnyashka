<?
require_once 'connect.php';
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['is_admin'] === 1) {
        $categories = $connect->query("SELECT * FROM categories")->fetchAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $del = $connect->prepare("DELETE FROM categories WHERE id = ?");
            $del->execute([$_POST['category']]);
            header('Location: menu.php');
            die();
        }
        require_once 'top.php';
?>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="fs-3 text-center mb-2">Удалить категорию</div>
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
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
                            <div><input type="submit" class="btn btn-danger w-100" value="Удалить" /></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <? require_once 'bottom.php' ?>
<?
    } else {
        die("Это страница только для админа");
    }
}

?>