<?php
session_start();
require 'connection.php';
$page = 'exam_e_j';
$randomLySelectedWord = $user->selectRandomWord();
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
<div class="my-body">
    <h3 class="text-center">Write down the accurate japanese word of the given english word!</h3>
    <?php
    if(!empty($_SESSION['message'])){?>
        <h3 style="color: red" class="text-center"><?php echo $_SESSION['message']?></h3>
    <?php }
    unset($_SESSION['message']);
    ?>
    <div class="col-md-offset-3 col-md-6 my-form">
        <form class="form-horizontal" method="POST" action="result.php">
            <h2 class="text-center exam-ques"><?php echo strtoupper($randomLySelectedWord['english'])?></h2>
            <div class="form-group">
                <label class="control-label col-sm-2" for="japanese">Japanese:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="japanese" id="japanese" placeholder="Enter Japanese of the given english word" required>
                    <input type="hidden" name="accurate" value="<?php echo md5($randomLySelectedWord['japanese'])?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit"  name="submit" value="Submit" class="btn btn-success">
                    <a href="exam_english_to_japanese.php" class="btn btn-warning">Skip</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="utilities/js/jquery.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>