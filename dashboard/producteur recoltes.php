<?php
session_start();
require_once "../../php/config.php";

if(!isset($_SESSION['id'])){
    header("Location: ../../login.php");
    exit();
}

$id=$_SESSION['id'];

$recoltes=$pdo->prepare("SELECT * FROM recoltes WHERE utilisateur_id=? ORDER BY id DESC");
$recoltes->execute([$id]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>

<meta charset="UTF-8">

<title>Mes récoltes</title>

<link rel="stylesheet" href="../../assets/css/dashboard.css">

</head>

<body>

<h1>Mes récoltes</h1>

<a href="ajouter-recolte.php" class="btn">
Ajouter une récolte
</a>

<table>

<tr>

<th>Produit</th>

<th>Quantité</th>

<th>Prix</th>

<th>Localisation</th>

<th>Actions</th>

</tr>

<?php while($row=$recoltes->fetch()){ ?>

<tr>

<td><?= $row['produit']; ?></td>

<td><?= $row['quantite']; ?> Kg</td>

<td><?= $row['prix']; ?> FCFA</td>

<td><?= $row['localisation']; ?></td>

<td>

<a href="modifier-recolte.php?id=<?= $row['id']; ?>">Modifier</a>

|

<a href="supprimer-recolte.php?id=<?= $row['id']; ?>">Supprimer</a>

</td>

</tr>

<?php } ?>

</table>

</body>
</html>
