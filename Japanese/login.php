<?php
    session_start();
    require 'connection.php';
    $page = 'login';
    if(isset($_POST['submit'])){
        $userEmail = filter($_POST['userEmail']);
        $userPassword = filter($_POST['userPassword']);
        if($admin->isExistAdminByEmailAndPassword($userEmail,$userPassword)){
            $adminDetails = $admin->getAdminByEmailAndPassword($userEmail,$userPassword);
            $_SESSION['adminId'] = $adminDetails->id;
            header('location:add_word.php');
        }else{
            $_SESSION['message'] = 'There is no such user';
        }
    }
    function filter($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Jahangirnagar University</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/julogo.ai-converted.ico">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="utilities/css/style.css">
	<link rel="stylesheet" type="text/css" href="utilities/css/all.css">
</head>
<body>
<div class="my-body">
<h2 class="text-center">Login here to start!</h2>
<?php
if(!empty($_SESSION['message'])){?>
    <h3 style="color: red" class="text-center"><?php echo $_SESSION['message']?></h3>
<?php }
unset($_SESSION['message']);
?>
<div class="col-md-offset-3 col-md-6 my-form">
        <form class="form-horizontal" method="POST">
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="userEmail" id="email" placeholder="Enter email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="userPassword" id="pwd" placeholder="Enter password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit"  name="submit" value="Login" class="btn btn-info">
                </div>
            </div>
        </form>
    </div>
    </div>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>