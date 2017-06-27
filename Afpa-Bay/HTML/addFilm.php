<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Nouveau film &mdash; Afpa-Bay</title>
		<link rel="stylesheet" type="text/css" href="../CSS/main.css">
	</head>
	<body>
		<header>
			<a class="lienImgImportant" href="addFilm.php?ANNIHILER=true&edit=<?php echo $_GET['edit']?>"><img class="imgImportant imgDestroy" src="../IMG/destroy.jpg" /></a>
			<h1><a href="accueil.php">The Afpa Bay</a></h1>
			<img alt="Logo Afpa-Bay" src="../IMG/logoAfpaBay.png" />
		</header>
		<main>
			<form method="post" action="addFilm.php?ANNIHILER=false&edit=<?php echo $_GET['edit'];?>">
				<label>titre : </label><input type="text" name="titre" />
				<label>synopsis : </label><input type="textarea" name="synopsis">
				<label>jacquette : </label><input type="url" name="image" />
				<label>réalisateur : </label><input type="text" name="realisateur" />
				<label>acteurs : </label><input type="text" name="acteurs" />
				<label>genres : </label><input type="text" name="genres" />
				<label>date de parution</label><input type="number" name="dateParution" />
				<label>type</label><input type="text" name="type" />
				<label>durée</label><input type="number" name="duree" />
				<label>nationalité</label><input type="text" name="nationalite" />
				<label>trailer</label><input type="text" name="trailer" />
				<input type="submit" value="ok" />
			</form>
		</main>
		<?php 
			$bdd = new PDO('mysql:host=localhost;dbname=Afpa-Bay;charset=utf8','root','M!8qcTr63%');
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if ($_GET['ANNIHILER'] == "true" && $_GET['edit'] != 0) {
				$req = $bdd->prepare("DELETE FROM ListeFilm WHERE id = ".$_GET['edit']);
				$req->execute();
				header('Location: accueil.php');
			}
			if ($_GET['edit'] == 0) {
				if($_POST) {
					$req = $bdd->prepare("INSERT INTO ListeFilm(titre, realisateur, acteurs, genre, dateParution, type, duree, image, synopsis, nationalite, trailer) VALUES(:titre, :realisateur, :acteurs, :genres, :dateParution, :type, :duree, :image, :synopsis, :nationalite, :trailer)");
					$req->execute(array(
					'titre' => /*filter_input(INPUT_POST, */$_POST['titre'],// FILTER_SANITIZE_STRING),
					'realisateur' => /*filter_input(INPUT_POST, */$_POST['realisateur'],// FILTER_SANITIZE_STRING),
					'acteurs' => /*filter_input(INPUT_POST, */$_POST['acteurs'],// FILTER_SANITIZE_STRING),
					'genres' => /*filter_input(INPUT_POST, */$_POST['genres'],// FILTER_SANITIZE_STRING),
					'dateParution' => /*filter_input(INPUT_POST, */$_POST['dateParution'],// FILTER_SANITIZE_NUMBER_INT),
					'type' => /*filter_input(INPUT_POST, */$_POST['type'],// FILTER_SANITIZE_STRING),
					'duree' => /*filter_input(INPUT_POST, */$_POST['duree'],// FILTER_SANITIZE_NUMBER_INT),
					'image' => /*filter_input(INPUT_POST, */$_POST['image'],// FILTER_SANITIZE_URL),
					'synopsis' => /*filter_input(INPUT_POST, */$_POST['synopsis'],// FILTER_SANITIZE_STRING),
					'nationalite' => /*filter_input(INPUT_POST, */$_POST['nationalite'],// FILTER_SANITIZE_STRING),
					'trailer' => /*filter_input(INPUT_POST, */$_POST['trailer'],/* FILTER_SANITIZE_URL)*/));
				}
			} else {
				if($_POST) {
					$req = $bdd->prepare("UPDATE ListeFilm SET
						titre = :titre,
						realisateur = :realisateur,
						acteurs = :acteurs,
						genre = :genres,
						dateParution = :dateParution,
						type = :type,
						duree = :duree,
						image = :image,
						synopsis = :synopsis,
						nationalite = :nationalite,
						trailer = :trailer WHERE id = :id");
					$req->execute(array(
					'titre' => /*filter_input(INPUT_POST, */$_POST['titre'],// FILTER_SANITIZE_STRING),
					'realisateur' => /*filter_input(INPUT_POST, */$_POST['realisateur'],// FILTER_SANITIZE_STRING),
					'acteurs' => /*filter_input(INPUT_POST, */$_POST['acteurs'],// FILTER_SANITIZE_STRING),
					'genres' => /*filter_input(INPUT_POST, */$_POST['genres'],// FILTER_SANITIZE_STRING),
					'dateParution' => /*filter_input(INPUT_POST, */$_POST['dateParution'],// FILTER_SANITIZE_NUMBER_INT),
					'type' => /*filter_input(INPUT_POST, */$_POST['type'],// FILTER_SANITIZE_STRING),
					'duree' => /*filter_input(INPUT_POST, */$_POST['duree'],// FILTER_SANITIZE_NUMBER_INT),
					'image' => /*filter_input(INPUT_POST, */$_POST['image'],// FILTER_SANITIZE_URL),
					'synopsis' => /*filter_input(INPUT_POST, */$_POST['synopsis'],// FILTER_SANITIZE_STRING),
					'nationalite' => /*filter_input(INPUT_POST, */$_POST['nationalite'],// FILTER_SANITIZE_STRING),
					'trailer' => /*filter_input(INPUT_POST, */$_POST['trailer'],// FILTER_SANITIZE_URL)
					'id' => /*filter_input(INPUT_POST, */$_GET['edit'],/* FILTER_SANITIZE_URL)*/));
				}
			}
		?>
	</body>
</html>