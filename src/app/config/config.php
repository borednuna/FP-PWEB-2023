<!-- Username dan password disesuaikan pada pengaturan di database -->
<?php

namespace App\Config;

class Config
{
    public $hostname = "localhost";
    public $username = "root";
    public $password = "192168_omoT";
    public $dbname = "pweb_fp";

    public function __construct()
    {
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);
    }
}
