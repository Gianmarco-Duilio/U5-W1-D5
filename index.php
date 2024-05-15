<?php
require_once './classes/Database.php';
require_once './classes/Libri.php';

session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}


$database = new Database();
$db = $database->getConnection();

$libri = new Libri($db);

$books = $libri->getAllBooks();
include_once __DIR__ . "/includes/index-top.php"; ?>

<div>
    <div id="nav" class="d-flex mb-4 pt-3 justify-content-center align-items-end">
        <h1>Elenco Libri</h1>
        <div class="my-3 mx-4 d-flex flex-wrap">

            <a href="logout.php" id="btn" class=" ms-2">Logout</a>
        </div>
    </div>
    <div class="container">
        <div class="row mb-5">
            <?php foreach ($books as $book) : ?>
                <div class="col-lg-4 g-5">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($book['titolo']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($book['autore']) ?></h6>
                            <div class="d-flex justify-content-center">
                                <form method="post" action="delete_book.php">
                                    <input type="hidden" name="delete_id" value="<?= $book['id'] ?>">
                                    <button class="" type="submit">Elimina</button>
                                </form>
                                <a class=" ms-2" href="update_book.php?id=<?= $book['id'] ?>">Modifica</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <a href="add_book.php" id="btn" class="mt-5">Aggiungi Libro</a>
    </div>
</div>
</div>

<?php include_once __DIR__ . "/includes/index-bottom.php"; ?>