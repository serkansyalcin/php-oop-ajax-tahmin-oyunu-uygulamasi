<?php

require_once('game.php');

$game = new Game();
$objects = $game->getObjects();
$questionOne = $game->getQuestions()[0];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tahmin Oyunu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-3">
        <div class="card shadow">
            <div class="card-body">
                <form action="" id="questionForm">
                    <h5 class="card-title">Şunlardan birini aklında tut: <?=implode(", ", $objects)?></h5>
                    <p class="card-text"><?=$questionOne?></p>
                    <input type="hidden" name="question" value="<?=$questionOne?>">
                    <div class="yes-no-buttons">
                        <input type="submit" class="btn btn-success" value="Evet">
                        <input type="submit" class="btn btn-danger" value="Hayır">
                    </div>
                    <div class="reset-button d-none">
                        <input type="submit" class="btn btn-warning" value="Yeniden Başla">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>

        $("#questionForm").on('submit', (function(event) {
            event.preventDefault();
            var clickButton = $("input[type=submit][clicked=true]").val();
            var formData = new FormData(this);
            formData.append('answer', clickButton);
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: formData,
                processData: false,
                contentType: false,
                dataType:'JSON', 
                async : false,
                error: function (request, error) {
                    alert("Beklenmeyen bir hata oluştu lütfen daha sonra tekrar deneyiniz");
                },
                success: function(response) {
                    if(response.answer.question!=""){
                        $("#questionForm p").html(response.answer.question);
                        $("#questionForm input[type=hidden]").val(response.answer.question);
                    }else if(response.answer.object!=""){
                        $("#questionForm p").html("TUTTUĞUN NESNE : " + response.answer.object);
                        
                        $("#questionForm .yes-no-buttons").addClass("d-none");
                        $("#questionForm .reset-button").removeClass("d-none");
                    }
                }
            });
        }));

        $("#questionForm input[type=submit]").click(function() {
            $("input[type=submit]", $(this).parents("form")).removeAttr("clicked");
            $(this).attr("clicked", "true");
        });

        $("#questionForm .reset-button").click(function() {
            $("#questionForm input[type=hidden]").val("<?=$questionOne?>");
            $("#questionForm p").html("<?=$questionOne?>");

            $("#questionForm .yes-no-buttons").removeClass("d-none");
            $("#questionForm .reset-button").addClass("d-none");

        });

    </script>
</body>

</html>