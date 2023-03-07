<?
require_once 'connect.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_POST['password'] !== $_POST['password_repeat']) {
            die("Пароли не совпадают");
        }
        $stmt = $connect->prepare("INSERT INTO users (name, surname, patronymic, login, email, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$_POST['name'], $_POST['surname'], $_POST['patronymic'], $_POST['login'], $_POST['email'], md5($_POST['password'])]);
        header('Location: sign_in.php');
        die();
    }
?>
    <? require_once 'top.php'; ?>
    <div class="row justify-content-center">
        <div class="col col-lg-6">
            <form action="register.php" method="POST">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="form-floating mb-3"><input type="text" name="name" id="floatingName" class="form-control" placeholder="Имя" required><label for="floatingName">Имя</label></div>
                        <div class="form-floating mb-3"><input type="text" name="surname" id="floatingSurname" class="form-control" placeholder="Фамилия" required><label for="floatingSurname">Фамилия</label></div>
                        <div class="form-floating mb-3"><input type="text" name="patronymic" id="floatingPatr" class="form-control" placeholder="Отчество"><label for="floatingPatr">Отчество</label></div>
                        <div class="form-floating mb-3"><input type="text" name="login" id="floatingLogin" class="form-control" placeholder="Логин" required><label for="floatingLogin">Логин</label></div>
                        <div class="form-floating mb-3"><input type="email" name="email" id="floatingEmail" class="form-control" placeholder="Email" required><label for="floatingEmail">Email</label></div>
                        <div class="form-floating mb-3"><input type="password" name="password" id="floatingPass" class="form-control" placeholder="Пароль" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required><label for="floatingPass">Пароль</label></div>
                        <div class="form-floating mb-3"><input type="password" name="password_repeat" id="floatingPassrep" class="form-control" placeholder="Подтверждение пароля" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required><label for="floatingPassrep">Подтверждение пароля</label></div>
                        <div><input type="submit" class="btn btn-primary w-100" value="Зарегистрироваться"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <? require_once 'bottom.php'; ?>
<? } else {
    header('Location: about.php');
    die();
} ?>