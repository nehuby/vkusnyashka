<?
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user'])) {
    require_once 'connect.php';
    require_once 'top.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_SESSION['user']['id'];
        $input = file_get_contents('php://input');
        $decode = json_decode($input, true);
        $dish_id = $decode["dish_id"];
        $stmt = $connect->prepare("INSERT INTO cart (user_id, dish_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $dish_id]);
    }
    $user_id = $_SESSION['user']['id'];
    $cart = $connect->prepare(
        "SELECT
        dishes.id,
        dishes.name,
        dishes.price,
        dishes.photo,
        dishes.category,
        dishes.ingredients,
        dishes.country,
        dishes.quantity,
        cart.id,
        cart.user_id,
        cart.dish_id
    FROM
        dishes
    INNER JOIN cart ON dishes.id = cart.dish_id
    WHERE cart.user_id = ?
    ORDER BY dishes.id DESC"
    );
    $cart->execute([$user_id]);
    $cart = $cart->fetchAll();
    foreach ($cart as $key => $dish) {
        if ($key === array_key_first($cart)) { ?><div class="row justify-content-center"><? } ?>
            <div class="col-lg-4 g-2">
                <div class="card">
                    <div class="card-body">
                        <img class="d-block w-100 rounded" src="../uploads/<?= $dish["photo"] ?>" />
                        <div class="fs-4"><?= htmlspecialchars($dish["name"]) ?></div>
                        <div class="fs-5 mb-2"><?= htmlspecialchars($dish["price"]) ?>рублей</div>
                        <input type="number" class="form-control mb-3" value="1" min="1" max="<?= $dish["quantity"] ?>">
                        <?
                        if (isset($_SESSION['user'])) {
                        ?>
                            <a href="delete_cart.php?id=<?= $dish["id"] ?>" class="btn btn-danger w-100">Удалить</a>
                        <?
                        }
                        ?>
                    </div>
                </div>
            </div>
            <? if ($key % 3 == 2) { ?>
            </div>
            <div class="row">
            <? } ?>
            <? if ($key === array_key_last($cart)) { ?></div><? } ?>
    <?
    }
    ?>
    <? require_once 'bottom.php' ?>
<?
} else {
    die("Это страница только для авторизированного пользователя");
}
?>