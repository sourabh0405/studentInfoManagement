<?php 
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='index.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: index.php?page='.$corepage[0]);
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
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/solid.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap4.min.js"></script>
    <script src="../js/fontawesome.min.js"></script>
    <script src="../js/script.js"></script>
    <title>Admin Dashboard</title>
    <style>
        /* Custom Netflix-like styles */
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #333 !important;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar-dark .navbar-toggler-icon {
            background-color: #fff;
        }
        .navbar-nav .nav-link {
            color: #fff !important;
            margin-right: 20px;
            font-size: 1.2em;
        }
        .nav-link:hover {
            color: #aaa !important;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .list-group-item {
            background-color: transparent;
            border-color: #333;
            color: #fff !important;
            font-size: 1.2em;
        }
        .list-group-item.active {
            background-color: #333;
            border-color: #333;
        }
        .list-group-item-action:hover {
            background-color: #333;
            border-color: #333;
        }
        .content {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        /* Increased placeholder size and opacity */
        input::placeholder {
            font-size: 1.2em;
            opacity: 1;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php"><i class="fas fa-chart-line fa-3x"></i></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse justify-content-end" id="navbarSupportedContent">
        <?php $showuser = $_SESSION['user_login']; $haha = mysqli_query($db_con,"SELECT * FROM `users` WHERE `username`='$showuser';"); $showrow=mysqli_fetch_array($haha); ?>
        <ul class="nav navbar-nav ">
            <li class="nav-item"><a class="nav-link" href="index.php?page=user-profile"><i class="fa fa-user"></i>
                    Welcome <?php echo $showrow['name']; ?>!</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?page=add-student"><i class="fa fa-user-plus"></i>
                    Add Student</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?page=user-profile"><i class="fa fa-user"></i>
                    Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>
<br>
<div class="container">
    <h1><a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a> <small>Satistics Overview</small></h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user"></i> Dashboard</li>
        </ol>
    </nav>
    <div class="row student">
        <div class="col-sm-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="fa fa-users fa-3x"></i>
                        </div>
                        <div class="col-sm-8">
                            <div class="float-sm-right">&nbsp;<span style="font-size: 30px"><?php $stu=mysqli_query($db_con,'SELECT * FROM `student_info`'); $stu= mysqli_num_rows($stu); echo $stu; ?></span></div>
                            <div class="clearfix"></div>
                            <div class="float-sm-right">Total Students</div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item-primary list-group-item list-group-item-action">
                    <div class="row">
                        <div class="col-sm-8">
                            <p class="">All Students</p>
                        </div>
                        <div class="col-sm-4">
                            <a href="all-student.php"><i class="fa fa-arrow-right float-sm-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-4">
                            <i class="fa fa-users fa-3x"></i>
                        </div>
                        <div class="col-sm-8">
                            <div class="float-sm-right">&nbsp;<span style="font-size: 30px"><?php $tusers=mysqli_query($db_con,'SELECT * FROM `users`'); $tusers= mysqli_num_rows($tusers); echo $tusers; ?></span></div>
                            <div class="clearfix"></div>
                            <div class="float-sm-right">Total Users</div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item-primary list-group-item list-group-item-action">
                    <a href="index.php?page=all-users">
                        <div class="row">
                            <div class="col-sm-8">
                                <p class="">All Users</p>
                            </div>
                            <div class="col-sm-4">
                                <i class="fa fa-arrow-right float-sm-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">
                    <div class="row">
                        <?php $usernameshow = $_SESSION['user_login']; $userspro = mysqli_query($db_con,"SELECT * FROM `users` WHERE `username`='$usernameshow';"); $userrow=mysqli_fetch_array($userspro); ?>
                        <div class="col-sm-6">
                            <img class="showimg" src="images/<?php echo $userrow['photo']; ?>">
                            <div style="font-size: 20px"><?php echo ucwords($userrow['name']); ?></div>
                        </div>
                        <div class="col-sm-6">

                            <div class="clearfix"></div>
                            <div class="float-sm-right">Welcome!</div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item-primary list-group-item list-group-item-action">
                    <a href="index.php?page=user-profile">
                        <div class="row">
                            <div class="col-sm-8">
                                <p class="">Your Profile</p>
                            </div>
                            <div class="col-sm-4">
                                <i class="fa fa-arrow-right float-sm-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>New Students</h3>
    <table class="table  table-striped table-hover table-bordered" id="data">
        <thead class="thead-dark">
        <tr>
            <th scope="col">SL</th>
            <th scope="col">Name</th>
            <th scope="col">Roll</th>
            <th scope="col">City</th>
            <th scope="col">Contact</th>
            <th scope="col">Photo</th>
        </tr>
        </thead>
        <tbody>
        <?php 
          $query=mysqli_query($db_con,'SELECT * FROM `student_info` ORDER BY `student_info`.`datetime` DESC;');
          $i=1;
          while ($result = mysqli_fetch_array($query)) { ?>
          <tr style="color: #FFF;"> <!-- Added inline CSS to set text color to white -->
            <?php 
            echo '<td>'.$i.'</td>
              <td>'.ucwords($result['name']).'</td>
              <td>'.$result['roll'].'</td>
              <td>'.ucwords($result['city']).'</td>
              <td>'.$result['pcontact'].'</td>
              <td><img src="images/'.$result['photo'].'" height="50px"></td>';?>
          </tr>  
         <?php $i++;} ?>
        
        </tbody>
    </table>
</div>
</body>
</html>
