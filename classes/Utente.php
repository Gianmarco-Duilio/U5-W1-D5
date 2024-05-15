<?php
class Utente
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function trovaUtentePerUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
