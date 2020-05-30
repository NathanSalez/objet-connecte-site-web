<?php
include("./ressources/config.php");

$id="";
if( ! isset($_POST["id"]) || $_POST["id"] == "")
    die("Problème de connexion, veuillez contacter l'organisateur au 06 21 45 87 41");
else
    $id = $_POST["id"];
$pdo = new PDO("mysql:host=" . $BDD_host . ";dbname=" . $BDD_base, $BDD_user, $BDD_password);
$reponse = "";
exec("cat ./pid",$pidCat);
if( count($pidCat) != 0)
	$pid=$pidCat[0];
else
	die("Tu peux  partir là :)");
exec("./ressources/envoyer_signal.exe $pid > /dev/null");
sleep(1);
exec("cat ./resultat",$reponseCat);
$reponse = $reponseCat[0];
$couleur = $LED_ENUM[(int)$reponse];
$sth = $pdo->query("SELECT * FROM propositions where idQuestion=$idQuestion and couleur='$couleur'");
$reponseDetail= $sth->fetchAll(PDO::FETCH_ASSOC)[0];
$idProposition = $reponseDetail["id"];
$stmt = $pdo->prepare("INSERT INTO reponses(idProposition,identifiantUser) VALUES(?,?)");
$stmt->execute([$idProposition, $id]);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
	<?php
		if( $reponseDetail["vraie"] )
		{
			exec("./ressources/montrer_reponse.exe 0 > /dev/null &");
			echo "vrai";
		} else
		{
			exec("./ressources/montrer_reponse.exe 1 > /dev/null &");
			echo "faux";
		}
	?>
</body>
</html>

