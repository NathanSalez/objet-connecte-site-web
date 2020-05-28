<?php
include("./ressources/config.php");

$pdo = new PDO("mysql:host=" . $BDD_host . ";dbname=" . $BDD_base, $BDD_user, $BDD_password);

$sth = $pdo->query("SELECT * FROM questions where id=$idQuestion");
$question = $sth->fetchAll(PDO::FETCH_ASSOC)[0];
$sth = $pdo->query("SELECT * FROM propositions WHERE idQuestion=$idQuestion");
$answers = $sth->fetchAll(PDO::FETCH_ASSOC);
exec("./ressources/selectionner_reponse.exe > /dev/null &");
//shell_exec("./ressources/selectionner_reponse.exe >out.txt");
//`echo "./ressources/selectionner_reponse.exe"  |at now`
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <div class="container-fluid" id="mainContainer" style="height: 100vh">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3><span class="label label-warning" id="qid">1</span><?= $question["intitule"] ?></h3>
                </div>
                <div class="modal-body">
                    <div class="col-xs-3 col-xs-offset-5">
                        <div id="loadbar" style="display: none;">
                            <div class="blockG" id="rotateG_01"></div>
                            <div class="blockG" id="rotateG_02"></div>
                            <div class="blockG" id="rotateG_03"></div>
                            <div class="blockG" id="rotateG_04"></div>
                            <div class="blockG" id="rotateG_05"></div>
                            <div class="blockG" id="rotateG_06"></div>
                            <div class="blockG" id="rotateG_07"></div>
                            <div class="blockG" id="rotateG_08"></div>
                        </div>
                    </div>

                    <div class="quiz" id="quiz" data-toggle="buttons">
                        <?php
                        for ($i = 0; $i < count($answers); $i++) :
                            $a = $answers[$i];
                            if ($a["couleur"] == "ROUGE") :
                                if ($a["vraie"] == 1) $indexAns = 1; ?>
                                <label class="element-animation2 btn btn-lg btn-danger btn-block"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span> <input type="radio" name="q_answer" value="1"><?= $a["intitule"] ?></label>

                            <?php elseif ($a["couleur"] == "ORANGE") :
                                if ($a["vraie"] == 1) $indexAns = 22; ?>
                                <label class="element-animation1 btn btn-lg btn-warning btn-block"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span> <input type="radio" name="q_answer" value="21"><?= $a["intitule"] ?></label>

                            <?php elseif ($a["couleur"] == "VERTE") :
                                if ($a["vraie"] == 1) $indexAns = 0; ?>
                                <label class="element-animation3 btn btn-lg btn-success btn-block"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span> <input type="radio" name="q_answer" value="0"><?= $a["intitule"] ?></label>

                            <?php elseif ($a["couleur"] == "JAUNE") :
                                if ($a["vraie"] == 1) $indexAns = 21; ?>
                                <label class="element-animation4 btn btn-lg btn-block" style="background-color: yellow"><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span> <input type="radio" name="q_answer" value="20"><?= $a["intitule"] ?></label>
                        <?php
                            endif;
                        endfor; ?>
                    </div>
                </div>
                <div class="modal-footer text-muted">
                    <form action="resultat.php">
                        <input type="submit" class=" btn btn-primary" value="Envoyer" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
