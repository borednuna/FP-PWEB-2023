<?php

namespace App\Config\Authentication;

use App\Config\Config;

class LoginHandler
{
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect((new Config())->hostname, (new Config())->username, (new Config())->password, (new Config())->dbname);
    }

    public function loginUser(string $email, string $password_input): string
    {
        $sql = "SELECT nomor_pengguna, role, password FROM pengguna WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($nomor_pengguna, $role, $password);
        $stmt->fetch();
        $stmt->close();
        
        if ($password === $password_input) {
            session_start();
            $_SESSION['nomor_pengguna'] = $nomor_pengguna;
            $_SESSION['role'] = $role;
            setcookie("nomor_pengguna", $nomor_pengguna, 0, "/");
            return $role;
        }

        return -1;
    }
}
