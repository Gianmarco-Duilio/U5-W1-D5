<?php
class Libri
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllBooks()
    {
        $stmt = $this->db->prepare("SELECT * FROM libri");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBookByID($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM libri WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function addBook($titolo, $autore)
    {
        $stmt = $this->db->prepare("INSERT INTO libri(titolo, autore) VALUES (:titolo, :autore)");
        $stmt->execute([
            ':titolo' => $titolo,
            ':autore' => $autore,
        ]);
    }
    public function updateBook($id, $titolo, $autore)
    {
        $stmt = $this->db->prepare("UPDATE libri SET titolo=:titolo, autore=:autore WHERE id=:id");
        $stmt->execute([
            ':id' => $id,
            ':titolo' => $titolo,
            ':autore' => $autore,
        ]);
    }
    public function deleteBook($id)
    {
        $stmt = $this->db->prepare("DELETE FROM libri WHERE id = ?");
        $stmt->execute([$id]);
    }
}
