<?php
	require 'connection.php';
	$page = 'index';
	$allWords = $user->getWords();
	$_SESSION['message'] = count($allWords).' words found';
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
            $_SESSION['message'] = count($allWords).' words found';
        }
        if($_GET['lessonNo'][0] != 'none'){
            $allWords = $user->getWordsByLessonNo($_GET['lessonNo'][0]);
            $_SESSION['message'] = count($allWords).' words found';
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
    <style type="text/css">
    	tr:hover{
    		background-color: skyblue;
    	}
    </style>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<div class="container">
		<h3 class="text-center">Word List</h3>
		<?php
	    if(!empty($_SESSION['message'])){?>
	        <h3 style="color: red" class="text-center"><?php echo $_SESSION['message']?></h3>
	    <?php }
	    unset($_SESSION['message']);
	    ?>
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
					<option value="none">None</option>
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
					<option value="12">12<option>
					<option value="13">13<option>
					<option value="14">14<option>
					<option value="15">15<option>
					<option value="16">16<option>
					<option value="17">17<option>
					<option value="18">18<option>
					<option value="19">19<option>
				</select>
				<input type="submit" name="submit" class="btn btn-success" value="Search">
			</form>
		</div>
		<div class="my-table">
            <?php
            if(empty($allWords)) {?>
                <h3 class="text-center" style="color: orangered;">No data found</h3>
            <?php } ?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Japanese</th>
						<th>English</th>
						<th>Lessson No</th>
						<th>Pronounciation</th>
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
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<div align="center">
				<ul class="pagination text-center">
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
	</div>
    <script src="utilities/js/jquery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('searchSuggestion').style.display = 'none';
        $(document).ready(function () {
            $('#searchField').keyup(function () {
                var query = $(this).val();
                if(query != ''){
                    $.ajax({
                        url:"word_search.php",
                        method:"POST",
                        data:{query:query},
                        success:function (data) {
                            $('#searchSuggestion').fadeIn();
                            $('#searchSuggestion').html(data);
                        }
                    });
                }
            }) ;
            $(document).on('click','li',function () {
                $('#searchWord').val($(this).text());
                $('#searchSuggestion').fadeOut();
            });
        });
    </script>
</body>
</html>