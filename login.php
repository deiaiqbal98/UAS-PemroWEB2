<?php
ob_start();
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

include "config.php";

if ($_SESSION['admin']) {
    header("location:index.php");
} else {

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Halaman Login - Data Relawan Covid19</title>
        <!-- Favicon-->
        <link rel="shortcut icon" href="images/covid.ico">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body class="login-page" style="background-image: url('images/bg.png')">
        <div class="login-box">
            <div class="logo">
                <small><img src="images/covid.png" alt="Logo" width="200" height="200"></small>
            </div>
            <div class="card">
                <div class="body">
                    <form id="sign_in" method="POST">
                        <div class="msg">Masukan Username dan Password</div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <input type="submit" class="btn btn-block bg-light-blue waves-effect" name="login" value="LOGIN">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Jquery Core Js -->
        <script src="plugins/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core Js -->
        <script src="plugins/bootstrap/js/bootstrap.js"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="plugins/node-waves/waves.js"></script>

        <!-- Validation Plugin Js -->
        <script src="plugins/jquery-validation/jquery.validate.js"></script>

        <!-- Custom Js -->
        <script src="js/admin.js"></script>
        <script src="js/pages/examples/sign-in.js"></script>
    </body>

    </html>

    <?php
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = $_POST['login'];

    if ($login) {

        $sql = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$username' AND password='$password'");
        $ketemu = mysqli_num_rows($sql);

        $data = mysqli_fetch_assoc($sql);

        if ($ketemu >= 1) {
            session_start();

            if ($data['level'] == "admin") {
                $_SESSION['admin'] = $data['id_user'];
                header("location:index.php");
            }
        } else {
    ?>
            <script type="text/javascript">
                alert("Login Gagal! \nUsername dan Password SALAH!");
            </script>
<?php
        }
    }
}
?>