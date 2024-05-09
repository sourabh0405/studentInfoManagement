<?php require_once 'admin/db_con.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Student Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        /* Custom Netflix-like styles */
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .btn-primary {
            background-color: #e50914;
            border-color: #e50914;
        }
        .btn-primary:hover {
            background-color: #ff0000;
            border-color: #ff0000;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .infotable {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }
        input[type="text"], select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            background-color: #333;
            border: 1px solid #444;
            color: #fff;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #e50914;
            border: none;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #ff0000;
        }
        .table-bordered {
            border-color: #444;
        }
        .table-bordered td, .table-bordered th {
            border-color: #444;
        }
        /* Set text color of student information table entries to white */
        .table-bordered td, .table-bordered th {
            color: #FFF !important;
        }

    </style>
</head>
<body>
<div class="container">
    <h1>Welcome to Student Management System!</h1>

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form method="POST">
                <table class="text-center infotable">
                    <tr>
                        <th colspan="2">
                            <p class="text-center">Student Information</p>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <p>Choose Class</p>
                        </td>
                        <td>
                            <select class="form-control" name="choose">
                                <option value="">Select</option>
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                                <option value="3rd">3rd</option>
                                <option value="4th">4th</option>
                                <option value="5th">5th</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p><label for="roll">Roll No</label></p>
                        </td>
                        <td>
                            <input class="form-control" type="text" pattern="[0-9]{6}" id="roll" placeholder="Roll Num.." name="roll">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <input class="btn btn-danger" type="submit" name="showinfo">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <br>
    <?php if (isset($_POST['showinfo'])) {
        $choose= $_POST['choose'];
        $roll = $_POST['roll'];
        if (!empty($choose && $roll)) {
            $query = mysqli_query($db_con,"SELECT * FROM `student_info` WHERE `roll`='$roll' AND `class`='$choose'");
            if (!empty($row=mysqli_fetch_array($query))) {
                if ($row['roll']==$roll && $choose==$row['class']) {
                    $stroll= $row['roll'];
                    $stname= $row['name'];
                    $stclass= $row['class'];
                    $city= $row['city'];
                    $photo= $row['photo'];
                    $pcontact= $row['pcontact'];
                    ?>
                    <div class="row">
                        <div class="col-sm-6 offset-sm-3">
                        <h3>Student Info</h3>
                            <table class="table table-bordered">
                                <tr>
                                    <td rowspan="5"><img class="img-thumbnail" src="admin/images/<?= isset($photo)?$photo:'';?>" width="250px"></td>
                                    <td>Name</td>
                                    <td><?= isset($stname)?$stname:'';?></td>
                                </tr>
                                <tr>
                                    <td>Roll</td>
                                    <td><?= isset($stroll)?$stroll:'';?></td>
                                </tr>
                                <tr>
                                    <td>Class</td>
                                    <td><?= isset($stclass)?$stclass:'';?></td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td><?= isset($city)?$city:'';?></td>
                                </tr>
                                <tr>
                                    <td>Submit Date</td>
                                    <td><?= isset($pcontact)?$pcontact:'';?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                <?php
                }else{
                    echo '<p style="color:red;">Please Input Valid Roll & Email</p>';
                }
            }else{
                echo '<p style="color:red;">Your Input Doesn\'t Match!</p>';
            }
        }else{?>
            <script type="text/javascript">alert("Data Not Found!");</script>
        <?php }
    }; ?>
</div>

<div class="container">
    <a class="btn btn-primary float-right" href="admin/login.php">Admin Login</a>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
