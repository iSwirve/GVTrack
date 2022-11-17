<?php
ob_start();
require "../controller.php";
$ctr = new controller();
if (!isset($_SESSION["loggedUser"])) {
    header("Location: ../index.php");
}

if ($_SESSION["loggedUser"]["role"] != "ADMIN") {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GVTrack - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link rel="stylesheet" href="../css.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#" style="margin-left: 10px;">GVTrack</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="adminUser.php">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="adminParameter.php">Parameter</a>
                </li>
            </ul>
        </div>
        <form method="post">
        <button name="logoutBtn" class="btn btn-danger" type="submit">Logout</button>

        </form>

    </nav>
</body>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swee17awatalert2@11"></script>
<script>

</script>
<?php 
if (isset($_POST["logoutBtn"])) {
    header("Location: ../index.php");
    unset($_SESSION["loggedUser"]);
}
?>
</html>