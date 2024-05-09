<?php require_once 'db_con.php'; 
session_start();
if(isset($_SESSION['user_login'])){
    header('Location: index.php');
}
    if (isset($_POST['login'])) {
        $username= $_POST['username'];
        $password= $_POST['password'];

        $input_arr = array();

        if (empty($username)) {
            $input_arr['input_user_error']= "Username Is Required!";
        }

        if (empty($password)) {
            $input_arr['input_pass_error']= "Password Is Required!";
        }

        if(count($input_arr)==0){
            $query = "SELECT * FROM `users` WHERE `username` = '$username';";
            $result = mysqli_query($db_con, $query);
            if (mysqli_num_rows($result)==1) {
                $row = mysqli_fetch_assoc($result);
                if ($row['password']==sha1(md5($password))) {
                    if ($row['status']=='active') {
                        $_SESSION['user_login']=$username;
                        header('Location: index.php');
                    } else {
                        $status_inactive = "Your Status is inactive, please contact with admin or support!";
                    }
                } else {
                    $worngpass= "This password Wrong!";    
                }
            } else {
                $usernameerr= "Username Not Found!";
            }
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Login Users</title>
    <style>
        /* Custom Netflix-like styles */
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            padding-top: 50px;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }
        .btn-warning {
            background-color: #e50914;
            border-color: #e50914;
        }
        .btn-warning:hover {
            background-color: #ff0000;
            border-color: #ff0000;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
        }
        .animate__animated {
            animation-duration: 1s;
        }
        .toast {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        label {
            color: #ff0000;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <h1 class="text-center">Login Users!</h1>
        <div class="row animate__animated animate__pulse">
            <div class="col-md-12">
                <form method="POST" action="">
                    <?php if(isset($usernameerr)){ ?>
                        <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade show" data-delay="2000"><?php echo $usernameerr; ?></div>
                    <?php };?>
                    <?php if(isset($worngpass)){ ?>
                        <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade show" data-delay="2000"><?php echo $worngpass; ?></div>
                    <?php };?>
                    <?php if(isset($status_inactive)){ ?>
                        <div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-danger fade show" data-delay="2000"><?php echo $status_inactive; ?></div>
                    <?php };?>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" value="<?= isset($username)? $username: ''; ?>" placeholder="Username">
                        <?php echo isset($input_arr['input_user_error'])? '<label>'.$input_arr['input_user_error'].'</label>':''; ?>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <?php echo isset($input_arr['input_pass_error'])? '<label>'.$input_arr['input_pass_error'].'</label>':''; ?>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="login" class="btn btn-warning">Sign in</button>
                    </div>
                </form>
                <p class="text-center">If you don't have a user account, you can <a href="register.php">register here</a>.</p>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $('.toast').toast('show')
    </script>
  </body>
</html>
