<nav class="navbar navbar-expand-lg border-bottom mb-3">
    <div class="container">
        <a class="navbar-brand" href="about.php">Вкусняшка</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbars" aria-controls="navbars" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbars">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="about.php">О нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php">Меню</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="location.php">Где нас найти?</a>
                </li>
                <?
                if (isset($_SESSION['user'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Корзина</a>
                    </li>
                <?
                }
                ?>
            </ul>
            <div class="text-end">
                <?
                if (isset($_SESSION['user'])) {
                ?>
                    <a href="logout.php" class="btn btn-primary">Выход</a>
                <?
                } else {
                ?>
                    <a href="sign_in.php" class="btn btn-primary">Вход</a>
                    <a href="register.php" class="btn btn-primary">Регистрация</a>
                <?
                }
                ?>
            </div>
        </div>
    </div>
</nav>