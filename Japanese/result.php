<?php
session_start();
require 'connection.php';
$page = 'exam_e_j';
if(isset($_POST['submit'])){
    /*die('died'.'<pre>'.print_r($_POST,true));*/
    $answer = filter($_POST['japanese']);
    $answer = unpack("C*", $answer);
    $answer = md5(json_encode($answer));
    if($answer == $_POST['accurate']){
        $_SESSION['message'] = 'Correct Answer';
    }else{
        $_SESSION['message'] = 'Wrong Answer';
    }
    header('location:exam_english_to_japanese.php');
}
if(isset($_POST['submit_other'])){
    $answer = filter($_POST['english']);
    if($answer == $_POST['accurate']){
        $_SESSION['message'] = 'Correct Answer';
    }else{
        $_SESSION['message'] = 'Wrong Answer';
    }
    header('location:exam_japanese_to_english.php');
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
    <title>Exam English to Japanese</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/julogo.ai-converted.ico">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="utilities/css/style.css">
</head>
<body>
<?php include 'navbar.php'?>

<script src="utilities/js/jquery.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>