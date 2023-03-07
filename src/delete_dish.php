<?
require_once 'connect.php';
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['is_admin'] === 1) {
        $stmt = $connect->prepare("SELECT * FROM dishes WHERE id = ?");
        $stmt->execute([$_GET["id"]]);
        $stmt = $stmt->fetch();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $del = $connect->prepare("DELETE FROM dishes WHERE id = ?");
            $del->execute([$_GET["id"]]);
            header('Location: menu.php');
            die();
        }
        require_once 'top.php';
?>
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="fs-4 text-center mb-3">Хотите удалить "<span class="fw-bold"><?= htmlspecialchars($stmt["name"]) ?></span>"?</div>
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