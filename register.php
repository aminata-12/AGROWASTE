<?php
session_start();
require_once "php/config.php";

$message="";

if(isset($_POST['register'])){

$nom=htmlspecialchars($_POST['nom']);
$prenom=htmlspecialchars($_POST['prenom']);
$email=htmlspecialchars($_POST['email']);
$telephone=htmlspecialchars($_POST['telephone']);
$role=$_POST['role'];
$password=password_hash($_POST['password'],PASSWORD_DEFAULT);

$check=$pdo->prepare("SELECT id FROM utilisateurs WHERE email=?");
$check->execute([$email]);

if($check->rowCount()>0){

$message="Cet email existe déjà.";

}else{

$sql=$pdo->prepare("INSERT INTO utilisateurs(nom,prenom,email,telephone,mot_de_passe,role)
VALUES(?,?,?,?,?,?)");

$sql->execute([
$nom,
$prenom,
$email,
$telephone,
$password,
$role
]);

header("Location: login.php");

}

}
?>

<!DOCTYPE html>
<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Inscription | AGROWASTE</title>

<link rel="stylesheet" href="assets/css/auth.css">

</head>

<body>

<div class="form-container">

<h2>Créer un compte</h2>

<p style="color:red;"><?php echo $message; ?></p>

<form method="POST">

<input type="text" name="nom" placeholder="Nom" required>

<input type="text" name="prenom" placeholder="Prénom" required>

<input type="email" name="email" placeholder="Email" required>

<input type="text" name="telephone" placeholder="Téléphone">

<select name="role">

<option value="producteur">Producteur</option>

<option value="acheteur">Acheteur</option>

</select>

<input type="password" name="password" placeholder="Mot de passe" required>

<button type="submit" name="register">

S'inscrire

</button>

</form>

<a href="login.php">

Déjà un compte ?

</a>

</div>

</body>

</html>
