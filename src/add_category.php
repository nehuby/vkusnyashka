<?
require_once 'connect.php';
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['is_admin'] === 1) {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $connect->prepare("INSERT INTO categories (name) VALUES (?)");
            $stmt->execute([$_POST['name']]);
            header('Location: menu.php');
            die();
        } ?>
        <? require_once 'top.php'; ?>
        <div class="row justify-content-center">
            <div class="col col-lg-6">
                <div class="fs-3 text-center mb-2">Добавить категорию</div>
                <form action="add_category.php" method="POST">
                    <div class="card mt-3">
                        <div class="card-body">
                            <div class="form-floating mb-3">
                                <input type="text" name="name" id="floatingName" class="form-control" placeholder="Название категории" required>
                                <label for="floatingName">Название категории</label>
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