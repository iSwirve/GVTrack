<?php
ob_start();
require "../controller.php";

// require "../func.php";
$ctr = new controller();
if (!isset($_SESSION["loggedUser"])) {
    header("Location: ../index.php");
}

if ($_SESSION["loggedUser"]["role"] != "CHAMP") {
    header("Location: ../index.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link rel="stylesheet" href="css.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#" style="margin-left: 10px;">GVTrack</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
            </ul>
        </div>
        <form action="" method="post">
            <button name="logoutBtn" class="btn btn-danger" type="submit">Logout</button>

        </form>

    </nav>

    <div class="container">
        <h1>GuestVoice</h1>
        <br><br>
        <form method="post">

            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">Current Score</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    $marsha = $_SESSION['loggedUser']['property'];
                    $paramArr = $ctr->loadParam();
                    $paramScore = $ctr->loadScore($marsha);
                    $i = 0;
                    foreach ($paramArr as $data) {
                    ?>
                        <tr>
                            <td><?= $data['paramname'] . " : " ?></td>
                            <td>
                                <input type="text" name="<?= $data['paramcode'] ?>mtd" placeholder='mtd' id="">

                            </td>
                            <td>
                                <input type="text" name="<?= $data['paramcode'] ?>ytd" placeholder='ytd' id="">
                            </td>

                            <td><?php if (isset($paramScore[$i]['score'])) {
                                    echo $paramScore[$i]['score'];
                                } else {
                                    echo 'unset';
                                } ?></td>
                        </tr>


                    <?php
                        $i++;
                    }
                    ?>
                    </tr>

                </tbody>
            </table>
            <br>
            <button class="btn btn-success" name="submitBtn">Submit</button> <br> <br><br>
            <div style="width:100%; border : 1px solid black"></div>

        </form>
        <br>

        <h2>Target</h2>

        <form method="post">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Parameter</th>
                        <th scope="col">U</th>
                        <th scope="col">P</th>
                        <th scope="col">SP</th>
                        <th scope="col">K</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($paramArr as $data) {
                    ?>
                        <tr>
                            <td><?= $data['paramname'] ?></td>
                            <td><input type="text" name="<?= $data['paramcode'] ?>u" id=""></td>
                            <td><input type="text" name="<?= $data['paramcode'] ?>p" id=""></td>
                            <td><input type="text" name="<?= $data['paramcode'] ?>sp" id=""></td>
                            <td><input type="text" name="<?= $data['paramcode'] ?>k" id=""></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                
            </table>
            <button class="btn btn-success" name="targetBtn">Submit target</button>
        </form>
         <br><br><br>
    </div>


</body>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="../sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swee17awatalert2@11"></script>

<script>

</script>
<?php
if (isset($_POST["logoutBtn"])) {
    header("Location: ../index.php");
    unset($_SESSION["loggedUser"]);
}

if (isset($_POST['submitBtn'])) {
    $paramArr = $ctr->loadParam();

    $arrScore = array();
    $isFail = false;
    foreach ($paramArr as $data) {
        $tbMtd = $_POST[$data['paramcode'] . 'mtd'];
        $tbYtd = $_POST[$data['paramcode'] . 'ytd'];
        $tbTar = 90;

        if ($tbMtd == '' || $tbYtd == "") {
            $ctr->swal("Input tidak valid", "Field tidak boleh kosong", "error");
            $isFail = true;
            break;
        } else {
            $arrScore[$data['paramcode']] = array(
                'mtd' => $tbMtd,
                'ytd' => $tbYtd,
                'target' => 90
            );
        }
    }

    if (!$isFail) {
        $property = $_SESSION["loggedUser"]["property"];
        $ctr->insertScore($arrScore, $property);
    }
}

if(isset($_POST['targetBtn']))
{
    $paramArr = $ctr->loadParam();
    $arrTarget = array();
    $isNull = false;
    $marsha = $_SESSION["loggedUser"]["property"];
    foreach($paramArr as $data)
    {
        $u = $_POST[$data['paramcode']."u"];
        $p = $_POST[$data['paramcode']."p"];
        $sp = $_POST[$data['paramcode']."sp"];
        $k = $_POST[$data['paramcode']."k"];
        if($u == "" && $p == "" && $sp == "" &&  $k == "")
        {
            $isNull = true;
            break;
        }
        $arrTarget[$data['paramcode']] = array(
            'u'=> $u,
            'p' => $p,
            'sp' => $sp,
            'k' => $k
        );
    }   

    if($isNull)
    {
        $ctr->swal("error", "Field tidak boleh kosong", "error");
    }
    else{
        $ctr->addTarget($arrTarget, $marsha);
    }
}


?>

</html>