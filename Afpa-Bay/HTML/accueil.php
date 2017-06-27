<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Accueil &mdash; Afpa-Bay</title>
		<link rel="stylesheet" type="text/css" href="../CSS/main.css">
	</head>
	<body>
		<header>
			<a class="lienImgImportant" href="addFilm.php?ANNIHILER=false&edit=0"><img class="imgImportant" src="../IMG/Add.png"></a>
			<h1><a href="accueil.php">The Afpa Bay</a></h1>
			<img alt="Logo Afpa-Bay" src="../IMG/logoAfpaBay.png" />
		</header>
		<nav>
			<form method="post" action="accueil.php">
				<input type="text" name="recherche" />
				<input type="submit" name="ok" value="Rechercher" />
			</form>
		</nav>
		<main>
			<ul>
				<?php
				    $bdd = new PDO('mysql:host=localhost;dbname=Afpa-Bay;charset=utf8','root','M!8qcTr63%');
					if (!($_POST))$reponse = $bdd->query('SELECT * from ListeFilm');
					else $reponse = $bdd->query('SELECT * from ListeFilm WHERE titre LIKE "%'.$_POST['recherche'].'%"');
					$donnees = $reponse->fetch(PDO::FETCH_ASSOC);
					if (!($donnees)) echo '<p class="error">Il n\'y a aucun résultat pour "'.$_POST['recherche'].'"</p>';
					do
					{
					    if($donnees) echo "<li class='film'>";
					    else echo "<li class='hidden'>";
					    	echo "<div class='filmInfo'>
					    		<a target='_blank' href='".$donnees["image"]."'>
					    			<img src='".$donnees["image"]."' />
						    	</a>
							    <div class='filmInfoText'>
						    		<a href='../HTML/filmDetail.php?id=".$donnees['id']."'>
							    		<h3>".$donnees["titre"]."</h3>
							    	</a>
							    	<p class='synopsis'>".$donnees['synopsis']."</p>
							    	<p class='infoDivers'>".$donnees["type"]." | ".$donnees["dateParution"]." | ".$donnees["duree"]." min
							    </div>
						    </div>
						    <div class='tag'>
						    	<p>".$donnees["genre"]."</p>
						    </div>
					    </li>";
					} while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC));
				?>
			</ul>
		</main>
		<footer>
			
		</footer>
	</body>
</html>