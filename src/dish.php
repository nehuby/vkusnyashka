<?
require_once 'connect.php';
require_once 'top.php';
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
?>
<div class="row justify-content-center">
    <div class="col-lg-8 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="el">
                    <div class="col d-flex justify-content-center fs-5"><?= htmlspecialchars($stmt["name"]) ?></div>
                </div>
            </div>
        </div>
        <div class="card my-2">
            <div class="card-body">
                <img class="w-100 rounded" height="500px" src="../uploads/<?= $stmt["photo"] ?>" alt=" <?= htmlspecialchars($stmt["name"]) ?>" />
            </div>
        </div>
        <div class="card mb-2">
            <div class="card-body">
                <div class="fs-6">
                    <div>Цена: <?= htmlspecialchars($stmt["price"]) ?> рублей</div>
                    <div>Категория: <?= htmlspecialchars($stmt["category_name"]) ?></div>
                    <div>Состав: <?= htmlspecialchars($stmt["ingredients"]) ?></div>
                    <div>Страна: <?= htmlspecialchars($stmt["country"]) ?></div>
                    <div>Количество: <?= htmlspecialchars($stmt["quantity"]) ?>шт.</div>
                </div>
            </div>
        </div>
    </div>
</div>
<? require_once 'bottom.php' ?>