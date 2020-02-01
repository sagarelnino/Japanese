<?php
session_start();
require 'connection.php';
$page = 'generate_question';
if(isset($_POST['submit'])){
    $noOfQuestions = filter($_POST['noOfQuestions']);
    $option = filter($_POST['options'][0]);
    $questions = $user->selectRandomWordByLimit($noOfQuestions);
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
    <title>Question</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/julogo.ai-converted.ico">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="utilities/css/style.css">
    <style type="text/css">
        .checkAnswer{
            display: none;
        }
        .sh{
            margin-bottom: 2%;
        }
        @media print {
            .sh{
                display: none;
            }
        }
    </style>
</head>
<body>
<?php include 'navbar.php' ;?>
<h2 class="text-center">Practice Test</h2>
    <?php
        if($option == 'e_j'){?>
            <div class="col-md-offset-2 col-md-8">
                <h4> Convert English to Japanese</h4>
                <button class="sh btn btn-info" onclick="myFun()">See/Hide Answer</button>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>SN</th>
                        <th>English</th>
                        <th>Japanese</th>
                    </tr>
                    <?php
                    $i = 1;
                        foreach ($questions as $singleQuestion){?>
                            <tr>
                                <td>
                                    <?php
                                        echo $i;
                                        $i++;
                                    ?>
                                </td>
                                <td><?php echo $singleQuestion['english']?></td>
                                <td><p class="checkAnswer">
                                    <?php
                                    $japanese = json_decode($singleQuestion['japanese']);
                                    $res = '';
                                    foreach ($japanese as $arr) {
                                        $res .= chr($arr);
                                    }
                                    echo $res;
                                    ?></p>
                                </td>
                            </tr>
                        <?php }
                    ?>
                </table>
            </div>
        <?php }else{ ?>
            <div class="col-md-offset-2 col-md-8">
                <h4> Convert Japanese to English</h4>
                <button class="sh btn btn-info" onclick="myFun()">See/Hide Answer</button>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>SN</th>
                        <th>Japanese</th>
                        <th>English</th>
                    </tr>
                    <?php
                    $i = 1;
                    foreach ($questions as $singleQuestion){?>
                        <tr>
                            <td>
                                <?php
                                    echo $i;
                                    $i++;
                                ?>
                            </td>
                            <td>
                                    <?php
                                    $japanese = json_decode($singleQuestion['japanese']);
                                    $res = '';
                                    foreach ($japanese as $arr) {
                                        $res .= chr($arr);
                                    }
                                    echo $res;
                                    ?>
                            </td>
                            <td><p class="checkAnswer"><?php echo $singleQuestion['english']?></p></td>
                        </tr>
                    <?php }
                    ?>
                </table>
            </div>
       <?php }
    ?>
<script src="utilities/js/jquery.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script>
    function myFun() {
        var divs = document.getElementsByClassName('checkAnswer');
        for(var i=0;i<divs.length;i++){
            if(divs[i].style.display === 'none'){
                divs[i].style.display = 'block';
            }else{
                divs[i].style.display = 'none';
            }
        }
    }
</script>
</body>
</html>