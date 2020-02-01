<?php
	require 'session_required.php';
	require 'connection.php';
	$page = 'index';
	$allWords = $user->getWords();
    if(!isset($_GET['searchWord'])){
        $_GET['searchWord'] = '';
    }
    if (isset($_GET['page_no']) && $_GET['page_no']!="") {
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }
    $total_records_per_page = 30;
    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";
    $total_records = $user->getWordsNumber();
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1;
    $allWords = $user->getAllWordsWithLimit($offset,$total_records_per_page);

    if(isset($_GET['submit'])){
        if(isset($_GET['searchWord'])){
            $allWords = $user->getWordsLikeEnglishOrPronounciation($_GET['searchWord']);
        }
        if(isset($_GET['lessonNo'][0])){
            $allWords = $user->getWordsByLessonNo($_GET['lessonNo'][0]);
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Word List</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/julogo.ai-converted.ico">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="utilities/css/style.css">
    <link rel="stylesheet" type="text/css" href="utilities/css/all.css">
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container">
        <div align="center" class="alert alert-info">
            <form class="form-inline" method="GET">
                Search Word: <input type="text" id="searchWord" name="searchWord" class="form-control" placeholder="Enter Search Word here" value="<?php echo $_GET['searchWord'] ?>">
                <div id="searchSuggestion"></div>
                Lesson:
                <select name="lessonNo[]" class="form-control">
                    <?php
                    if (isset($_GET['lessonNo'][0])){?>
                        <option value="<?php echo $_GET['lessonNo'][0]?>"><?php echo $_GET['lessonNo'][0]?></option>
                    <?php }
                    ?>
                    <option>None</option>
                    <option value="0">0<option>
                    <option value="1">1<option>
                    <option value="2">2<option>
                    <option value="3">3<option>
                    <option value="4">4<option>
                    <option value="5">5<option>
                    <option value="6">6<option>
                    <option value="7">7<option>
                    <option value="8">8<option>
                    <option value="9">9<option>
                    <option value="10">10<option>
                    <option value="11">11<option>
                </select>
                <input type="submit" name="submit" class="btn btn-success" value="Search">
            </form>
        </div>
		<div class="my-table">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Japanese</th>
						<th>English</th>
						<th>Lessson No</th>
						<th>Pronounciation</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($allWords as $singleWord) {?>
						<tr>
							<th class="alert alert-success">
							<?php 
								$japanese = json_decode($singleWord['japanese']);
								$res = '';
								foreach ($japanese as $arr) {
									$res .= chr($arr);
								}
								echo $res;
							?>
							</th>
							<td><?php echo $singleWord['english']; ?></td>
							<td><?php echo $singleWord['lessonNo']; ?></td>
							<td><?php echo $singleWord['pronounciation']; ?></td>
							<td><a class="btn btn-info" href="update_word.php?id=<?php echo $singleWord['id'] ?>">Update</a> <a class="btn btn-warning" onclick="return confirm('Are you sure?')" href="delete_word.php?id=<?php echo $singleWord['id'] ?>">Delete</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
            <ul class="pagination text-center" style="margin-left: 30%">
                <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
                    <a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
                </li>

                <?php
                if ($total_no_of_pages <= 10){
                    for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                        if ($counter == $page_no) {
                            echo "<li class='active'><a>$counter</a></li>";
                        }else{
                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                        }
                    }
                }
                elseif($total_no_of_pages > 10){

                    if($page_no <= 4) {
                        for ($counter = 1; $counter < 8; $counter++){
                            if ($counter == $page_no) {
                                echo "<li class='active'><a>$counter</a></li>";
                            }else{
                                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                        echo "<li><a>...</a></li>";
                        echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                    }

                    elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                        echo "<li><a href='?page_no=1'>1</a></li>";
                        echo "<li><a href='?page_no=2'>2</a></li>";
                        echo "<li><a>...</a></li>";
                        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                            if ($counter == $page_no) {
                                echo "<li class='active'><a>$counter</a></li>";
                            }else{
                                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                        echo "<li><a>...</a></li>";
                        echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                        echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                    }

                    else {
                        echo "<li><a href='?page_no=1'>1</a></li>";
                        echo "<li><a href='?page_no=2'>2</a></li>";
                        echo "<li><a>...</a></li>";

                        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                            if ($counter == $page_no) {
                                echo "<li class='active'><a>$counter</a></li>";
                            }else{
                                echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                            }
                        }
                    }
                }
                ?>

                <li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
                    <a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
                </li>
                <?php if($page_no < $total_no_of_pages){
                    echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                } ?>
            </ul>
		</div>
	</div>
    <script src="utilities/js/jquery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>