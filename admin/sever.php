<?php 
	session_start();
	
	$username = "";
	$email    = "";
	$_SESSION['success'] = "";
	$errors = array(); 
	


	require_once 'module/config.php';


	if (isset($_POST['reg_user'])) {
		$username = $con_db -> real_escape_string($_POST['username']);
		$email = $con_db -> real_escape_string($_POST['email']);
		$password_1 = $con_db -> real_escape_string($_POST['password_1']);
		$password_2 = $con_db -> real_escape_string($_POST['password_2']);


		if (empty($username)) { array_push($errors, "Username không được để trống"); }
		if (empty($email)) { array_push($errors, "Email không được để trống"); }
		if (empty($password_1)) { array_push($errors, "Password không được để trống"); }

		if ($password_1 != $password_2) {
			array_push($errors, "2 mật khẩu không trùng khớp");
		}

		if (count($errors) == 0) {
			$query = "INSERT INTO users (username, email, password) 
					  VALUES('$username', '$email', '$password')";
			mysqli_query($query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "Đăng kí thành công";
			header('location: index.php');
		}

	}



	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = $con_db -> real_escape_string($_POST['username']);
		$password = $con_db -> real_escape_string($_POST['password']);

		if (!empty($username)) {
			echo( "Username không được để trống");
		}
		if (empty($password)) {
			array_push($errors, "Password không được để trống");
		}

		if (count($errors) == 0) {
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = $con_db->query($query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, '<h5><span class="badge badge-danger">Sai mật khẩu hoặc tên tài khoản</span></h5>');
			}
		}
	}

?>