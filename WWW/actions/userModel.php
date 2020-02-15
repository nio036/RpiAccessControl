<?php
require '../common.php';
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['btn_submit']))
	{
		$username 	= $_POST['txt_name'];
		$rfid 		= $_POST['txt_rfid_uid'];
		if($username != null && $username != "" && $rfid != null && $rfid != "")
		{
			$users = $database->select("users", ['id','name','rfid_uid'], ["rfid_uid[=]" => $rfid]);
			if(count($users) > 0)
			{
				$_SESSION['error'] = "The RFID_UID is already assigned to another user";
				header("Location: ../add-user.php");
	 		}
			else
			{
				$rs = $database->insert("users", [
					"name" => $username,
					"rfid_uid" => $rfid
				]);
				if($rs->rowCount() > 0)
				{
					$_SESSION['msg'] = "User is added successfully";
					header("Location: ../users.php");
				}
				else
				{
					$_SESSION['error'] = "Unable to process the query";
					header("Location: ../add-user.php");
				}
			}
		}
		else
		{
			$_SESSION['error'] = "Please fill all the fields";
			header("Location: ../add-user.php");
		}
	}
}
if($_SERVER['REQUEST_METHOD'] == "GET")
{
	if (isset($_GET['act']) && $_GET['act'] == "del")
	{
		if(isset($_GET['id']) && $_GET['id'] != 0 && $_GET['id'] != null && $_GET['id'] != "")
		{
			if(isset($_GET['rfid']) && $_GET['rfid'] != 0 && $_GET['rfid'] != null && $_GET['rfid'] != "")
			{
				$data = $database->update("users", ["rfid_uid" => "","status" => 0, "del_rfid_uid"=>$_GET['rfid']], ["id[=]" => $_GET['id']]);
				if($data->rowCount() > 0)
				{
					$_SESSION['msg'] = "User is deleted successfully";
					header("Location: ../users.php");
				}
				else
				{
					$_SESSION['error'] = "Unable to process the query";
					header("Location: ../users.php");
				}
			}
			else
			{
				$_SESSION['error'] = "No user found";
				header("Location: ../users.php");
			}
		}
		else
		{
			$_SESSION['error'] = "No user found";
			header("Location: ../users.php");
		}
	}
	else if (isset($_GET['act']) && $_GET['act'] == "active")
	{
		if(isset($_GET['id']) && $_GET['id'] != 0 && $_GET['id'] != null && $_GET['id'] != "")
		{
			if(isset($_GET['rfid']) && $_GET['rfid'] != 0 && $_GET['rfid'] != null && $_GET['rfid'] != "")
			{
				$data = $database->update("users", ["rfid_uid" => "","status" => 1, "rfid_uid"=>$_GET['rfid']], ["id[=]" => $_GET['id']]);
				if($data->rowCount() > 0)
				{
					$_SESSION['msg'] = "User is now activated successfully";
					header("Location: ../users.php");
				}
				else
				{
					$_SESSION['error'] = "Unable to process the query";
					header("Location: ../users.php");
				}
			}
			else
			{
				$_SESSION['error'] = "No user found";
				header("Location: ../users.php");
			}
		}
		else
		{
			$_SESSION['error'] = "No user found";
			header("Location: ../users.php");
		}
	}
	else
	{
		$_SESSION['error'] = "Unable to specify what to do";
		header("Location: ../users.php");
	}
}
?>