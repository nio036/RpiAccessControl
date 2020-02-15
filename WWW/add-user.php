<?php
require 'common.php';
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
                <h2>Add User</h2>
            </div>
        </div>
        <div class="row">
            <div  class="col-md-3"></div>
            <div  class="col-md-6">
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
                <form class="form-horizontal" method="post" action="actions/userModel.php">
                    <div class="row" >
                        <div class="form-group col-md-12">
                            <label class="control-label" for="txt_name">Enter User's Name</label>
                            <input type="text" name="txt_name" required="true" id="txt_name" class="form-control" title="Enter User's Name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label" for="txt_rfid_uid">Enter RFID of User</label>
                            <input type="text" name="txt_rfid_uid" required="true" id="txt_rfid_uid" class="form-control" title="Enter RFID of User">
                        </div>
                    </div>
                    <div class="row text-center">
                    	<div class="col-md-6">
                    		<button class="btn btn-success btn-block" name="btn_submit" type="submit">Save User</button>
                    	</div>
                    	<div class="col-md-6">
                            <a href="users.php" class="btn btn-danger btn-block">Cancel & Go back</a>
                        </div>
                    </div>
                </form>
            </div>
            <div  class="col-md-3"></div>
        </div>
    </div>
</html>
