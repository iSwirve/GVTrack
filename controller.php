<?php
session_start();
require "func.php";

class controller
{
    public function loadProperty()
    {
        require "connection.php";
        return $conn->query("SELECT * FROM property")->fetch_all(MYSQLI_ASSOC);
    }

    public function loadUser()
    {
        require "connection.php";
        return $conn->query("SELECT * FROM users ORDER BY username ASC")->fetch_all(MYSQLI_ASSOC);
    }

    public function loadParam()
    {
        require "connection.php";
        return $conn->query("SELECT * FROM parameters ORDER BY paramname asc")->fetch_all(MYSQLI_ASSOC);
    }

    public function loadScore($marsha)
    {
        require "connection.php";
        return $conn->query("SELECT parameters.paramname as paramname, gv.mtd as score, gv.ytd as scorey, gv.target as target FROM parameters,gv WHERE gv.paramcode = parameters.paramcode AND marsha = '$marsha'")->fetch_all(MYSQLI_ASSOC);
    }

    public function insertScore($dataScore, $marsha)
    {
        require "connection.php";
        $conn->query("DELETE FROM gv WHERE marsha = '$marsha'");
        $arrParam = $conn->query("SELECT * FROM parameters ORDER BY paramname asc")->fetch_all(MYSQLI_ASSOC);

        foreach ($arrParam as $data) {
            $paramcode = $data['paramcode'];
            $mtd = $dataScore[$paramcode]['mtd'];
            $ytd = $dataScore[$paramcode]['ytd'];
            $target = $dataScore[$paramcode]['target'];

            $conn->query("INSERT INTO gv VALUES('$paramcode','$mtd', '$ytd','$target','$marsha')");
        }
    }


    public function loginCheck($user, $pass)
    {
        require "connection.php";
        $temp = array();
        $temp = (array) $conn->query("SELECT * FROM users")->fetch_all(MYSQLI_ASSOC);
        $isFound = false;
        foreach ($temp as $dat) {
            if ($dat["username"] == $user) {
                $isFound = true;
                if ($dat["password"] == $pass) {
                    $_SESSION["loggedUser"] = $dat;

                    switch ($dat["role"]) {
                        case "ADMIN":
                            header("location: admin/admin.php");
                            break;
                        case "CHAMP":
                            header("location: champion/champion.php");
                            break;
                    }
                } else {
                    swal("Password anda salah", "Silahkan coba lagi atau kontak administrator", "error");
                }
            }
        }
        if (!$isFound) {
            swal("User tidak ditemukan", "Silahkan coba lagi atau kontak administrator", "error");
        }
    }

    function swal($title, $text, $icon)
    {
        // echo "<script>alert('$message');</script>";
        echo "<script type=\"text/javascript\">
        Swal.fire({
            title: '$title',
            text: '$text',
            icon: '$icon',
        });
        
        </script>";
    }
    function alert($message)
    {
        echo "<script>alert('$message');</script>";
    }

    function refresh()
    {
        echo "<script>location.reload()</script>";
    }
}
