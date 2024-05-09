<?php 
$user=  $_SESSION['user_login'];
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage!=='index.php') {
  if ($corepage==$corepage) {
    $corepage = explode('.', $corepage);
   header('Location: index.php?page='.$corepage[0]);
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        /* Custom CSS for setting text color to white */
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .breadcrumb{
          background-color: #000;
        }
        .breadcrumb-item a {
            color: #fff;
        }
        .breadcrumb-item.active {
            color: #fff;
        }
        .table-bordered th,
        .table-bordered td {
            border-color: #fff;
            color: #fff;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #000;
        }
        .btn-warning:hover {
            background-color: #ffca28;
            border-color: #ffca28;
            color: #000;
        }
        .img-thumbnail {
            border: 2px solid #fff;
        }
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: #fff;
        }
        .btn-info:hover {
            background-color: #138496;
            border-color: #138496;
            color: #fff;
        }
    </style>
</head>
<body>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
       <li class="breadcrumb-item" aria-current="page"><a href="index.php">Dashboard</a></li>
       <li class="breadcrumb-item active" aria-current="page">User Profile</li>
    </ol>
</nav>
<?php 
$query = mysqli_query($db_con, "SELECT * FROM `users` WHERE `username` ='$user';");
$row = mysqli_fetch_array($query);
?>
<div class="row">
    <div class="col-sm-6">
        <table class="table table-bordered">
            <tr>
                <td>User ID</td>
                <td><?php echo $row['id']; ?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo ucwords($row['name']); ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $row['email']; ?></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><?php echo ucwords($row['username']); ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?php echo ucwords($row['status']); ?></td>
            </tr>
            <tr>
                <td>Register Date</td>
                <td><?php echo $row['datetime']; ?></td>
            </tr>
        </table>
        <a class="btn btn-warning pull-right" href="index.php?page=edit-user&id=<?php echo base64_encode($row['id']); ?>">Edit Profile</a>
    </div>
    <div class="col-sm-6">
        <h3>Profile Picture</h3>
        <a href="images/<?php echo $row['photo']; ?>">
            <img class="img-thumbnail" id="imguser" src="images/<?php echo $row['photo']; ?>" width="200px">
        </a>
        <?php 
            if (isset($_POST['upphoto'])) {
              unlink('images/'.$row['photo']);
              $photofile = $_FILES['userphoto']['tmp_name'];
              $upphoto = $user.date('s-m-y-m-Y').$_FILES['userphoto']['name'];
              if (mysqli_query($db_con, "UPDATE `users` SET `photo` = '$upphoto' WHERE `users`.`username` = '$user';")) {
                move_uploaded_file($photofile, 'images/'.$upphoto);
              }else{
                echo "Profile Picture Not Uploaded";
              }
            }
         ?><br>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="userphoto" required="" id="photo"><br>
            <input class="btn btn-info" type="submit" name="upphoto" value="Upload Photo">
        </form>
    </div>
</div>
</body>
</html>
