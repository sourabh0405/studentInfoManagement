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
    <link rel="stylesheet" type="text/css" href="../css/style.css">

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
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse collapse justify-content-end" id="navbarSupportedContent">
        <?php $showuser = $_SESSION['user_login']; $haha = mysqli_query($db_con,"SELECT * FROM `users` WHERE `username`='$showuser';"); $showrow=mysqli_fetch_array($haha); ?>
        <ul class="nav navbar-nav ">
          <li class="nav-item"><a class="nav-link" href="index.php?page=user-profile"><i class="fa fa-user"></i> Welcome <?php echo $showrow['name']; ?>!</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?page=add-student"><i class="fa fa-user-plus"></i> Add Student</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?page=user-profile"><i class="fa fa-user"></i> Profile</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
        </ul>
      </div>
    </nav>
    <br>
    <div class="container">
        <h1 class="text-primary"><i class="fas fa-users"></i>  All Users<small class="text-warning"> All Users List!</small></h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
             <li class="breadcrumb-item" aria-current="page"><a href="index.php">Dashboard </a></li>
             <li class="breadcrumb-item active" aria-current="page">All Users</li>
          </ol>
        </nav>
        <table class="table  table-striped table-hover table-bordered" id="data">
          <thead class="thead-dark">
            <tr>
              <th scope="col">SL</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Username</th>
              <th scope="col">Photo</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $query=mysqli_query($db_con,'SELECT * FROM `users`');
              $i=1;
              while ($result = mysqli_fetch_array($query)) { ?>
              <tr style="color: #fff;">
                <?php 
                echo '<td>'.$i.'</td>
                  <td>'.ucwords($result['name']).'</td>
                  <td>'.$result['email'].'</td>
                  <td>'.ucwords($result['username']).'</td>
                  <td><img src="images/'.$result['photo'].'" height="50px"></td>
                  <td>'.$result['status'].'</td>';?>
              </tr>  
             <?php $i++;} ?>
          </tbody>
        </table>
        <script type="text/javascript">
          function confirmationDelete(anchor)
        {
           var conf = confirm('Are you sure want to delete this record?');
           if(conf)
              window.location=anchor.attr("href");
        }
        </script>
    </div>
  </body>
</html>
