<?php

$host="localhost";
$dbname="agrowaste";
$user="root";
$password="";

try{

$pdo=new PDO(
"mysql:host=$host;dbname=$dbname;charset=utf8",
$user,
$password
);

$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){

die("Erreur : ".$e->getMessage());

}

?>
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
