<nav class="navbar navbar-default navbar-fixed-top my-nav">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php"><span class="ju">JAPANESE</span> <span class="uni">N5 VOCABULARY</span></a>
            <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navHeaderCollapse">
            <ul class="nav navbar-nav navbar-right">
                <li <?php if($page == 'index'){ echo 'class="active"';} ?>><a href="index.php">Home</a></li>
                <li class="dropdown <?php if($page == 'exam_e_j' || $page == 'exam_j_e'){ echo 'active';} ?>"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Exam<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li <?php if($page == 'exam_e_j'){ echo 'class="active"';} ?>><a href="exam_english_to_japanese.php">English to Japanese</a></li>
                        <li <?php if($page == 'exam_j_e'){ echo 'class="active"';} ?>><a href="exam_japanese_to_english.php">Japanese to English</a></li>
                    </ul>
                </li>
                <li class="dropdown <?php if($page == 'mcq_exam_e_j' || $page == 'mcq_exam_j_e'){ echo 'active';} ?>"><a class="dropdown-toggle" data-toggle="dropdown" href="#">MCQ<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li <?php if($page == 'mcq_exam_e_j'){ echo 'class="active"';} ?>><a href="mcq_exam_english_to_japanese.php">English to Japanese</a></li>
                        <li <?php if($page == 'mcq_exam_j_e'){ echo 'class="active"';} ?>><a href="mcq_exam_japanese_to_english.php">Japanese to English</a></li>
                    </ul>
                </li>      
                <li <?php if($page == 'generate_question'){ echo 'class="active"';} ?>><a href="generate_question.php">Generate Question</a></li>
                <li <?php if($page == 'login'){ echo 'class="active"';} ?>><a href="login.php">Admin</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>