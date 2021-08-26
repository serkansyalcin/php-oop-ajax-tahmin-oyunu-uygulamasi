<?php
require_once('game.php');

$result = array();

if(isset($_POST["question"])){
    $question = $_POST["question"];
}else{
    $question = "";
}

if(isset($_POST["answer"])){
    $answer = $_POST["answer"];
}else{
    $answer = "";
}

if($question!="" && $answer!=""){
    $game = new Game();

    $result["answer"] = $game->calculate($question, $answer);

    echo json_encode($result);

}
?>