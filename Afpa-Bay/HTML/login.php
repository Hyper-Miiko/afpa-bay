<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login &mdash; Afpa-Bay</title>
		<link rel="stylesheet" type="text/css" href="../CSS/main.css">
		<link rel="stylesheet" type="text/css" href="../CSS/login.css">
	</head>
	<body>
		<header>
			<h1><a href="accueil.php">The Afpa Bay</a></h1>
			<img alt="Logo Afpa-Bay" src="../IMG/logoAfpaBay.png" />
		</header>
		<main>
			<section id="enregistrement">
				<form method="post" action="login.php?act=en">
					<fieldset>
						<legend>Enregistrement</legend>
						<label>Identifiant</label>
						<input type="text" name="idLogin" placeHolder="identifiant" required />
						<label>Pseudo</label>
						<input type="text" name="Pseudo" placeHolder="pseudo" required/>
						<label>Mot de passe</label>
						<input type="password" name="mdpLogin" placeHolder="********" required/>
						<label>Confirmation du mot de passe</label>
						<input type="password" name="confMdpLogin" placeHolder="********" required/>
						<input type="submit" name="validEn" value="Je m'enregistre" />
					</fieldset>
				</form>
			</section>
			<section id="connection">
				<form method="post" action="login.php?act=co">
					<fieldset>
						<legend>Connection</legend>
						<label>Identifiant</label>
						<input type="text" name="idLogin" placeHolder="identifiant" required/>
						<label>Mot de passe</label>
						<input type="password" name="mdpLogin" placeHolder="********" required/>
						<input type="submit" name="validCo" value="Je me connecte" />
					</fieldset>
				</form>
			</section>
			<?php
				if (isset($_GET['act'])) {
					$bdd = new PDO('mysql:host=localhost;dbname=Afpa-Bay;charset=utf8','root','M!8qcTr63%');
					if ($_GET['act'] == "co") {
						$pwd = $bdd->query('SELECT pw from User WHERE user = "'.$_POST["idLogin"].'"');
						$mdp = $pwd->fetch(PDO::FETCH_ASSOC);
						if ($mdp['pw'] == hash('md5', $_POST['mdpLogin'])) {
							header('Location: login.php?act=ok');
							exit;
						}
						header('Location: login.php?act=ko');
						exit;
					} else if ($_GET['act'] == "en") {
						$req = $bdd->prepare('INSERT INTO User(user, pseudo, pw) VALUES(:idLogin, :Pseudo, :mdpLogin)');
						$req->execute(array('idLogin' => $_POST['idLogin'],
							'Pseudo' => $_POST['Pseudo'],
							'mdpLogin' => hash('md5', $_POST['mdpLogin'])));
					} else if ($_GET['act'] == "ok") {
					} else if ($_GET['act'] == "ko") {
					}
				}
			?>
		</main>
	</body>
</html>