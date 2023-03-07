<?
require_once 'connect.php';
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['user'])) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $connect->prepare("SELECT * FROM users WHERE login = ? AND password = ?");
        $stmt->execute([$_POST['login'], md5($_POST['password'])]);
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
            $_SESSION['user'] = [
                "id" => $user['id'],
                "is_admin" => $user['is_admin'],
            ];
            header('Location: about.php');
            die();
        } else {
            header('Location: sign_in.php');
            die();
        }
    }
?>
    <? require_once 'top.php'; ?>
    <div class="row justify-content-center">
        <div class="col col-lg-6">
            <form action="sign_in.php" method="POST">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="form-floating mb-3"><input type="text" name="login" class="form-control" id="floatingInput" placeholder="Логин" required><label for="floatingInput">Логин</label></div>
                        <div class="form-floating mb-3"><input type="password" name="password" class="form-control" id="floatingPass" placeholder="Пароль" required> <label for="floatingPass">Пароль</label></div>
                        <div><input type="submit" class="btn btn-primary w-100" value="Войти"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <? require_once 'bottom.php' ?>
<? } else {
    header('Location: about.php');
    die();
} ?>