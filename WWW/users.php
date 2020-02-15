<?php
require 'common.php';
//Grab all the active users from our database
$users = $database->select("users", ['id','name','rfid_uid'], ["status[=]" => 1]);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Access Control System</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Access Control System</a>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="attendance.php" class="nav-link">View Access Logs</a>
            </li>
            <li class="nav-item">
                <a href="users.php" class="nav-link active">View Users</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-3">
                <h2 >Users</h2>
            </div>
            <div class="col-md-6 text-right p-3">
                <a href="deleted-user.php" class="btn btn-sm btn-danger">View deleted user</a>
                <a href="add-user.php" class="btn btn-sm btn-primary">Add new user</a>
            </div>
        </div>
        <div class="col-md-12">
        <?php
        if(isset($_SESSION['error']))
        {
            ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Error!</strong> <?php echo $_SESSION['error']; ?>
            </div>
            <?php
            unset($_SESSION['error']);
        }
        if(isset($_SESSION['msg']))
        {
            ?>
            <div class="alert alert-success alert-dismissible fade show">
                <strong>Congratulation.!!!</strong> <?php echo $_SESSION['msg']; ?>
            </div>
            <?php
            unset($_SESSION['msg']);
        }
        ?>
        </div>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">RFID UID</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //Loop through and list all the information of each user including their RFID UID

                foreach($users as $user)
                {
                    echo '<tr>';
                    echo '<td scope="row">' . $user['id'] . '</td>';
                    echo '<td>' . $user['name'] . '</td>';
                    echo '<td>' . $user['rfid_uid'] . '</td>';
                    echo '<td><a href="actions/userModel.php?act=del&rfid='.$user['rfid_uid'].'&id='.$user['id'].'" class="text-danger txt_link">Delete</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</html>
