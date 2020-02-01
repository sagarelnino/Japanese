<?php
session_start();
require 'connection.php';
$page = 'generate_question';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Generate Question</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/julogo.ai-converted.ico">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="utilities/css/style.css">
</head>
<body>
<?php include 'navbar.php'?>
<div class="my-body">
    <h3 class="text-center">Customize!</h3>
    <?php
    if(!empty($_SESSION['message'])){?>
        <h3 style="color: red" class="text-center"><?php echo $_SESSION['message']?></h3>
    <?php }
    unset($_SESSION['message']);
    ?>
    <div class="col-md-offset-3 col-md-6 my-form">
        <form class="form-horizontal" method="POST" action="question.php">
            <div class="form-group">
                <label class="control-label col-sm-3" for="noOfQuestions">No of Questions:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="noOfQuestions" id="noOfQuestions" placeholder="Enter no of questions you want to have in question paper" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="options">Options:</label>
                <div class="col-sm-9">
                    <select name="options[]" class="form-control" id="options" required>
                        <option></option>
                        <option value="j_e">Japanese to English</option>
                        <option value="e_j">English to Japanese</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <input type="submit"  name="submit" value="Submit" class="btn btn-success">
                </div>
            </div>
        </form>
    </div>
</div>
<script src="utilities/js/jquery.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>