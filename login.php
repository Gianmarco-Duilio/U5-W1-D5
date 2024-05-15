<?php
require_once './classes/Database.php';
require_once './classes/Utente.php';

session_start();


$db = new Database();
$utente = new Utente($db->getConnection());

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($username) || empty($password)) {
        $errors['credentials'] = 'Inserisci nome utente e password.';
    } else {
        $utente_da_db = $utente->trovaUtentePerUsername($username);

        if ($utente_da_db && password_verify($password, $utente_da_db["password"])) {
            $_SESSION['user_id'] = $utente_da_db['username'];
            header("Location: /Corso Epicode-Ifoa Back End/U5-W1-D5/index.php");
            exit;
        } else {
            $errors['credentials'] = 'Credenziali non valide.';
        }
    }
}
?>

<?php include_once __DIR__ . "/includes/index-top.php"; ?>
<div class="container text-center">
    <h1 class="mt-5">BENVENUTO!</h1>
    <form class="row g-3" method="post" action="" novalidate>
        <div class="col-lg-12 col-xl-4"></div>
        <div class="col-lg-12 col-xl-4 mt-5">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
            <div class="valid-feedback">Looks good!</div>

            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <div class="valid-feedback">Looks good!</div>

            <button class="btn btn-primary m-3" type="submit">Login</button><br>

            <?php if (isset($errors['credentials'])) : ?>
                <div class="text-danger mt-2"><?= $errors['credentials'] ?></div>
            <?php endif; ?>
        </div>
        <div class="col-lg-12 col-xl-4"></div>
    </form>
</div>
<?php include_once __DIR__ . "/includes/index-bottom.php"; ?>