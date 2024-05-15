<?php
require_once './classes/Database.php';
require_once './classes/Libri.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $database = new Database();
    $db = $database->getConnection();
    $libri = new Libri($db);

    $libri->deleteBook($_POST['delete_id']);
    header("Location: index.php");
    exit();
}
