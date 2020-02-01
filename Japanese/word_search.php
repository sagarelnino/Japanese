<?php
require 'connection.php';
if(isset($_POST['query'])){
    $output = '<ul class="mystyle">';
    $searchResults = $user->getSearchedResults($_POST['query']);
    foreach ($searchResults as $searchResult){
        $output .= '<li>'.$searchResult["pronounciation"].' ('.$searchResult["english"].')</li>';
    }
    $output .= '</ul>';
    echo $output;
}
?>