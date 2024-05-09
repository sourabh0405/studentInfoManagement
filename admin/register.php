<?php require_once 'db_con.php'; 
	session_start();
	if (isset($_POST['register'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$c_password = $_POST['c_password'];

		$photo = explode('.', $_FILES['photo']['name']);
		$photo= end($photo);
		$photo_name= $username.'.'.$photo;

		$input_error = array();
		if (empty($name)) {
			$input_error['name'] = "The Name Field is Required";
		}
		if (empty($email)) {
			$input_error['email'] = "The Email Field is Required";
		}
		if (empty($username)) {
			$input_error['username'] = "The UserName Field is Required";
		}
		if (empty($password)) {
			$input_error['password'] = "The Password Field is Required";
		}
		if (empty($photo)) {
			$input_error['photo'] = "The Photo Field is Required";
		}

		if (!empty($password)) {
			if ($c_password!==$password) {
				$input_error['notmatch']="You Typed Wrong Password!";
			}
		}

		if (count($input_error)==0) {
			$check_email= mysqli_query($db_con,"SELECT * FROM `users` WHERE `email`='$email';");

			if (mysqli_num_rows($check_email)==0) {
				$check_username= mysqli_query($db_con,"SELECT * FROM `users` WHERE `username`='$username';");
				if (mysqli_num_rows($check_username)==0) {
					if (strlen($username)>7) {
						if (strlen($password)>7) {
								$password = sha1(md5($password));
							$query = "INSERT INTO `users`(`name`, `email`, `username`, `password`, `photo`, `status`) VALUES ('$name', '$email', '$username', '$password','$photo_name','inactive');";
									$result = mysqli_query($db_con,$query);
								if ($result) {
									move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo_name);
									header('Location: register.php?insert=sucess');
								}else{
									header('Location: register.php?insert=error');
								}
						}else{
							$passlan="This password more than 8 characters";
						}
					}else{
						$usernamelan= 'This username more than 8 characters';
					}
				}else{
					$username_error="This username already exists!";
				}
			}else{
				$email_error= "This email already exists";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <title>Register Users</title>
    <style>
        /* Custom Netflix-like styles */
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
            padding-top: 50px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .btn-danger {
            background-color: #e50914;
            border-color: #e50914;
        }
        .btn-danger:hover {
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
        label.error {
            color: #ff0000;
        }

        /* Increased placeholder size and opacity */
        input::placeholder {
            font-size: 1.2em;
            opacity: 0.8;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <h1 class="text-center">Register Users!</h1>
        <div class="d-flex justify-content-center">
            <?php 
                if (isset($_GET['insert'])) {
                    if($_GET['insert']=='sucess'){ echo '<div role="alert" aria-live="assertive" aria-atomic="true" align="center" class="toast alert alert-success fade show" data-delay="2000">Your Data Inserted!</div>';}
                }
            ;?>
        </div>
        <div class="row animate__animated animate__pulse">
            <div class="col-md-8 offset-md-2">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" value="<?= isset($name)? $name:'' ?>" name="name" placeholder="Name"><?= isset($input_error['name'])? '<label class="error">'.$input_error['name'].'</label>':'';  ?>
                        </div>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" value="<?= isset($email)? $email:'' ?>" name="email" placeholder="Email"><?= isset($input_error['email'])? '<label class="error">'.$input_error['email'].'</label>':'';  ?><?= isset($email_error)? '<label class="error">'.$email_error.'</label>':'';  ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <input type="text" name="username" value="<?= isset($username)? $username:'' ?>" class="form-control" placeholder="Username"><?= isset($input_error['usrname'])? '<label class="error">'.$input_error['username'].'</label>':'';  ?><?= isset($username_error)? '<label class="error">'.$username_error.'</label>':'';  ?><?= isset($usernamelan)? '<label class="error">'.$usernamelan.'</label>':'';  ?>
                        </div>
                        <div class="col-sm-4">
                            <input type="password" name="password" class="form-control" placeholder="Password"><?= isset($input_error['password'])? '<label class="error">'.$input_error['password'].'</label>':'';  ?> <?= isset($passlan)? '<label class="error">'.$passlan.'</label>':'';  ?>  
                        </div>
                        <div class="col-sm-4">
                            <input type="password" name="c_password" class="form-control" placeholder="Confirm Password"><?= isset($input_error['notmatch'])? '<label class="error">'.$input_error['notmatch'].'</label>':'';  ?> <?= isset($passlan)? '<label class="error">'.$passlan.'</label>':'';  ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><label for="photo" style="font-size: 1.2em; opacity: 0.8;">Choose your photo</label></div>
                        <div class="col-sm-9">
                            <input type="file" id="photo" name="photo" class="form-control" style="font-size: 1.2em; opacity: 0.8;">
                            <br>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="register" class="btn btn-danger">Register!</button>
                    </div>
                </form>
                <p class="text-center">If you have an account, you can <a href="login.php">login here</a>.</p>
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
