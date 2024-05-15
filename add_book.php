<?php
require_once './classes/Database.php';
require_once './classes/Libri.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    $libri = new Libri($db);

    $titolo = $_POST['titolo'];
    $autore = $_POST['autore'];

    $libri->addBook($titolo, $autore);

    header("Location: index.php");
    exit();
}

include_once __DIR__ . "/includes/index-top.php";
?>

<div class="container">
    <div class="form-container">
        <h1>Aggiungi Nuovo Libro</h1>
        <form method="post" action="add_book.php">
            <label for="titolo">Titolo:</label><br>
            <input type="text" id="titolo" name="titolo"><br>
            <label for="autore">Autore:</label><br>
            <input type="text" id="autore" name="autore"><br>
            <button type="submit">Aggiungi</button>
        </form>
    </div>
</div>

<?php include_once __DIR__ . "/includes/index-bottom.php"; ?>