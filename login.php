<?php

session_start();

require_once "php/config.php";

$message="";

if(isset($_POST['login'])){

$email=$_POST['email'];

$password=$_POST['password'];

$sql=$pdo->prepare("SELECT * FROM utilisateurs WHERE email=?");

$sql->execute([$email]);

$user=$sql->fetch();

if($user && password_verify($password,$user['mot_de_passe'])){

$_SESSION['id']=$user['id'];

$_SESSION['nom']=$user['nom'];

$_SESSION['role']=$user['role'];

if($user['role']=="admin"){

header("Location: dashboard/admin/index.php");

}elseif($user['role']=="producteur"){

header("Location: dashboard/producteur/index.php");

}else{

header("Location: dashboard/acheteur/index.php");

}

exit();

}else{

$message="Email ou mot de passe incorrect.";

}

}

?>

<!DOCTYPE html>

<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Connexion</title>

<link rel="stylesheet" href="assets/css/auth.css">

</head>

<body>

<div class="form-container">

<h2>Connexion</h2>

<p style="color:red;"><?php echo $message; ?></p>

<form method="POST">

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Mot de passe" required>

<button type="submit" name="login">

Se connecter

</button>

</form>

<a href="register.php">

Créer un compte

</a>

</div>

</body>

</html>
