<?php

namespace dao;

use PDO;
use model\User;

class UserDao
{
    private PDO $pdo;

    public function __construct()
    {
        $conf = [
            "dsn" => "mysql:host=localhost;dbname=ccib;charset=UTF8",
            "user" => "root",
            "password" => "",
        ];
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $this->pdo = new PDO(
            $conf["dsn"],
            $conf["user"],
            $conf["password"],
            $options
        );
    }

    public function addUser(User $user)
    {
        $req = $this->pdo->prepare("INSERT INTO user (pseudo, email, pwd) VALUES (:pseudo, :email, :pwd)");
        $req->execute([
            ":pseudo" => $user->getPseudo(),
            ":email" => $user->getEmail(),
            ":pwd" => $user->getPwd()
        ]);
    }
}
