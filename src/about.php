<?
require_once "connect.php";
require_once 'top.php';
?>
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card mb-2">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-1"><img src="../static/lg.png" alt="logo" height="70"></div>
                    <div class="fs-4 text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia totam doloribus, aspernatur voluptates tempore aut dolorem dicta minima in corrupti ullam quia consectetur, maiores ea fuga modi natus voluptatum deleniti.</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?
$stmt = $connect->query("SELECT * FROM dishes");
if ($stmt->rowCount() > 0) { ?>
    <div class="row justify-content-center">
        <div class="col-lg-8 mb-2">
            <div class="card">
                <div class="card-body">
                    <div id="carouselExampleControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?
                            require_once 'connect.php';
                            $slider = $connect->query("SELECT * FROM dishes ORDER BY id DESC LIMIT 5")->fetchAll();
                            foreach ($slider as $key => $i) {
                            ?>
                                <a href="dish.php?id=<?= $i["id"] ?>" class="text-decoration-none text-dark">
                                    <div class="carousel-item <? if ($key === array_key_first($slider)) { ?>active<? } ?>">
                                        <img src="../uploads/<?= $i["photo"] ?>" class="d-block w-100 rounded" alt="<?= $i["name"] ?>" height="500px" />
                                        <div class="card mt-2">
                                            <div class="card-body">
                                                <div class="fs-5 text-center"><?= $i["name"] ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? } ?>
<? require_once 'bottom.php'; ?>