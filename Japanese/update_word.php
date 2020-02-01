<?php
require 'session_required.php';
require 'connection.php';
$wordDetails = $user->getWordById($_GET['id']);
$japanese = json_decode($wordDetails['japanese']);
$res = '';
foreach ($japanese as $arr) {
    $res .= chr($arr);
}
if(isset($_POST['submit'])){
    $japanese = filter($_POST['japanese']);
    $japanese = unpack("C*", $japanese);
    $japanese = json_encode($japanese);
    $english = filter($_POST['english']);
    $lessonNo = filter($_POST['lessonNo'][0]);
    $details = filter($_POST['pronounciation']);
    $updated  = date('Y-m-d H:i:s');
    
    $user->updateWord($japanese,$english,$lessonNo,$details,$updated,$_GET['id']);
    $_SESSION['message'] = 'Word Successfully Updated!!';
    header('location:words_admin.php');
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
    <title>Add Word</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/julogo.ai-converted.ico">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="utilities/css/style.css">
</head>
<body>
<div class="my-body">
    <h2 class="text-center">Add Word!</h2>
    <?php
    if(!empty($_SESSION['message'])){?>
        <h3 style="color: red" class="text-center"><?php echo $_SESSION['message']?></h3>
    <?php }
    unset($_SESSION['message']);
    ?>
    <div class="col-md-offset-3 col-md-6 my-form">
        <form class="form-horizontal" method="POST">
            <div class="form-group">
                <label class="control-label col-sm-2" for="japanese">Japanese:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="japanese" id="japanese" placeholder="Enter Japanese" value="<?php echo $res; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="english">English:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="english" id="english" placeholder="Enter English" value="<?php echo $wordDetails['english']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="lessonNo">Lesson No:</label>
                <div class="col-sm-10">
                    <select class="form-control" name="lessonNo[]" id="lessonNo">
                        <option value="<?php echo $wordDetails['lessonNo'] ?>"><?php echo $wordDetails['lessonNo'] ?></option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="details">Pronouncing:</label>
                <div class="col-sm-10">
                    <input type="text" name="pronounciation" id="pronounciation" class="form-control" placeholder="Enter pronounciation in english" value="<?php echo $wordDetails['pronounciation'] ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit"  name="submit" value="Update" class="btn btn-info">
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script src="utilities/js/jquery.js"></script>
</body>
</html>