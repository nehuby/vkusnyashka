<?
require_once 'connect.php';
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
        cart.id,
        cart.user_id,
        cart.dish_id
    FROM
        dishes
    INNER JOIN cart ON dishes.id = cart.dish_id
    WHERE cart.id = ?
    ORDER BY dishes.id DESC"
);
$stmt->execute([$_GET["id"]]);
$stmt = $stmt->fetch();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $del = $connect->prepare("DELETE FROM cart WHERE id = ?");
    $del->execute([$_GET["id"]]);
    header('Location: cart.php');
    die();
}
require_once 'top.php';
?>
<div class="row justify-content-center">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="fs-4 text-center mb-3">Хотите удалить из корзины "<span class="fw-bold"><?= htmlspecialchars($stmt["name"]) ?></span>"?</div>
                    <div><input type="submit" class="btn btn-danger w-100" value="Удалить" /></div>
                </form>
            </div>
        </div>
    </div>
</div>
<? require_once 'bottom.php' ?>