<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Détail &mdash; Afpa-Bay</title>
		<link rel="stylesheet" type="text/css" href="../CSS/main.css">
		<link rel="stylesheet" type="text/css" href="../CSS/detail.css">
	</head>
	<body>
		<?php
			$bdd = new PDO('mysql:host=localhost;dbname=Afpa-Bay;charset=utf8','root','M!8qcTr63%');
			$reponse = $bdd->query('SELECT * from ListeFilm WHERE id = '.$_GET["id"]);
			$donnees = $reponse->fetch(PDO::FETCH_ASSOC);
		?>
		<header>
			<a class="lienImgImportant" href="addFilm.php?ANNIHILER=false&edit=<?php echo $donnees['id'];?>"><img class="imgImportant" src="../IMG/edit.png"></a>
			<h1><a href="accueil.php">The Afpa Bay</a></h1>
			<img alt="Logo Afpa-Bay" src="../IMG/logoAfpaBay.png" />
		</header>
		<main>
			<section>
				<div class="text">
					<h2><?php echo $donnees["titre"];?></h2>
					<p><?php echo $donnees["synopsis"];?></p>
				</div>
				<hr />
				<div class="list">
					<img src=<?php echo '"'.$donnees["image"].'"';?> />
					<ul>
						<li>Réalisateur :</li>
						<li>Acteurs :</li>
						<li>Genres :</li>
						<li>Date de parution :</li>
						<li>Type :</li>
						<li>Durée :</li>
						<li>Nationalité :</li>
					</ul>
					<ul>
						<li><?php
							if($donnees["realisateur"]) echo $donnees["realisateur"];
							else echo "???";
						?></li>
						<li><?php
							if($donnees["acteurs"]) echo $donnees["acteurs"];
							else echo "???";
						?></li>
						<li><?php 
							if($donnees["genre"]) echo $donnees["genre"];
							else echo "???";
						?></li>
						<li><?php 
							if($donnees["dateParution"]) echo $donnees["dateParution"];
							else echo "???";
						?></li>
						<li><?php 
							if($donnees["type"]) echo $donnees["type"];
							else echo "???";
						?></li>
						<li><?php 
							if($donnees["duree"]) echo $donnees["duree"];
							else echo "???";
						?></li>
						<li><?php 
							if($donnees["nationalite"]) echo $donnees["nationalite"];
							else echo "???";
						?></li>
					</ul>
				</div>
			</section>
			<section>
			 	<?php if($donnees["trailer"]) echo '<iframe src="https://www.youtube.com/embed/'.$donnees["trailer"].'"></iframe>';?>
			</section>
		</main>
	</body>
</html>