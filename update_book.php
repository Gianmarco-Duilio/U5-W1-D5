<?php
require_once './classes/Database.php';
require_once './classes/Libri.php';

session_start();

$database = new Database();
$db = $database->getConnection();
$libri = new Libri($db);

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    $book = $libri->getBookByID($book_id);
} else {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $titolo = $_POST['titolo'];
    $autore = $_POST['autore'];

    $libri->updateBook($id, $titolo, $autore);

    header("Location: index.php");
    exit();
}
include_once __DIR__ . "/includes/index-top.php"; ?>
<div class="container">
    <div class="form-container">
        <h1>Modifica Libro</h1>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?= $book['id'] ?>">
            <div class="mb-3">
                <label for="titolo" class="form-label">Titolo:</label>
                <input type="text" class="form-control" id="titolo" name="titolo" value="<?= htmlspecialchars($book['titolo']) ?>">
            </div>
            <div class="mb-3">
                <label for="autore" class="form-label">Autore:</label>
                <input type="text" class="form-control" id="autore" name="autore" value="<?= htmlspecialchars($book['autore']) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Aggiorna</button>
        </form>
    </div>
</div>
<?php include_once __DIR__ . "/includes/index-bottom.php"; ?>