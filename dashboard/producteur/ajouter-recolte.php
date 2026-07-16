<?php

session_start();

require "../../php/config.php";

if(isset($_POST['save'])){

$produit=$_POST['produit'];
$quantite=$_POST['quantite'];
$prix=$_POST['prix'];
$localisation=$_POST['localisation'];
$description=$_POST['description'];
$date=$_POST['date'];

$sql=$pdo->prepare("INSERT INTO recoltes(utilisateur_id,produit,quantite,prix,localisation,description,date_recolte)
VALUES(?,?,?,?,?,?,?)");

$sql->execute([
$_SESSION['id'],
$produit,
$quantite,
$prix,
$localisation,
$description,
$date
]);

header("Location: recoltes.php");

}
?>

<!DOCTYPE html>

<html>

<head>

<title>Ajouter une récolte</title>

<link rel="stylesheet" href="../../assets/css/dashboard.css">

</head>

<body>

<h1>Ajouter une récolte</h1>

<form method="POST">

<select name="produit">

<option>Oignon</option>

<option>Pomme de terre</option>

</select>

<input type="number" name="quantite" placeholder="Quantité">

<input type="number" name="prix" placeholder="Prix">

<input type="text" name="localisation" placeholder="Localisation">

<input type="date" name="date">

<textarea name="description"></textarea>

<button name="save">

Enregistrer

</button>

</form>

</body>

</html>
