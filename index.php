<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GVTrack - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link rel="stylesheet" href="css.css">
</head>

<body>
    <div class="registration-form">
        <form method="post">

            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>

            </div>
            <div>
                <span>
                    <h1 style="text-align: center; width: 100%">Login</h1>
                </span>

            </div>

            <div class="form-group">
                <input type="text" class="form-control item" name="user" placeholder="username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" name="pass" placeholder="password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn create-account" name="loginBtn">Login</button>
            </div>
            <div class="form-group">
                <a href="/propertyChoose.php">Go to Client</a>
            </div>

        </form>

        <script>

        </script>

    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swee17awatalert2@11"></script>
    <script>

    </script>
    <?php
    require "controller.php";
    $ctr = new controller();
    $user = "";
    $pass = "";
    if (isset($_POST["loginBtn"])) {
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $ctr->loginCheck($user, $pass);
    }

    // if(isset($_POST["clientBtn"]))
    // {
    //     header("Location: propertyChoose.php");
    // }


    ?>
</body>

</html>