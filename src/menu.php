<? require_once 'connect.php'; ?>
<? require_once 'top.php'; ?>
<?
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['is_admin'] === 1) {
?>

        <div class="row">
            <div class="col"><a href="add_dish.php" class="btn btn-primary w-100">Добавить блюдо</a></div>
            <div class="col"><a href="add_category.php" class="btn btn-primary w-100">Добавить категорию</a></div>
            <div class="col"><a href="delete_category.php" class="btn btn-danger w-100">Удалить категорию</a></div>
        </div>
<?
    }
}
?>
<?
$dishes = $connect->query("SELECT * FROM dishes ORDER BY id DESC")->fetchAll();
foreach ($dishes as $key => $dish) {
?>
    <? if ($key === array_key_first($dishes)) { ?><div class="row justify-content-center"><? } ?>
        <div class="col-lg-4 g-2">
            <div class="card">
                <div class="card-body">
                    <a href="dish.php?id=<?= $dish["id"] ?>" class="text-decoration-none text-dark">
                        <img class="d-block w-100 rounded" src="../uploads/<?= $dish["photo"] ?>" />
                        <div class="fs-4"><?= htmlspecialchars($dish["name"]) ?></div>
                        <div class="fs-5 mb-2"><?= htmlspecialchars($dish["price"]) ?> рублей</div>
                    </a>
                    <?
                    if (isset($_SESSION['user'])) {
                    ?>
                        <button type="button" id="btn_id" data-id="<?= $dish["id"] ?>" class="btn btn-success">В корзину</button>
                    <?
                    }
                    ?>
                    <?
                    if (isset($_SESSION['user'])) {
                        if ($_SESSION['user']['is_admin'] === 1) {
                    ?>
                            <a href="delete_dish.php?id=<?= $dish["id"] ?>" class="btn btn-danger">Удалить</a>
                            <a href="update_dish.php?id=<?= $dish["id"] ?>" class="btn btn-primary">Редактировать</a>
                    <?
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <? if ($key % 3 == 2) { ?>
        </div>
        <div class="row">
        <? } ?>
        <? if ($key === array_key_last($dishes)) { ?></div><? } ?>
<?
}
?>
<script src="../static/js/cart.js"></script>
<? require_once 'bottom.php'; ?>