<?php 
$bdd = new PDO('mysql:host=localhost;dbname=projet_cdi', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$id_media = $_GET['id_media'];
$auteur = $_GET['auteur'];
$editeur = $_GET['editeur'];

$requete = $bdd->query("SELECT * FROM medias WHERE id_media='".$id_media."';");
$donnees = $requete->fetchAll();
foreach ($donnees as $row) {
	$titre_media = $row['titre_media'];
	$descriptions = $row['resume_media'];
	$image="../images/".$row['nom_image'];
	$emprunt = $row['empruntable_media'];
}
?>

<html>
<header>
	<link rel="stylesheet" href="bootstrap/bootstrap.css" />
	<link rel="stylesheet" href="bootstrap/bootstrap-responsive.css" />
</header>
<body>

	<div class="row">
		<div class="span8">
			<img src="<?php echo $image; ?>" />
		</div>
		<div class="span4">
			<h1>
				<?php echo $titre_media; ?>
			</h1>
			<p>
			<br/>
			<br/>
			<strong> Auteur : </strong>
				<?php echo utf8_encode($auteur); ?>
			<br/>	
			<br/>
				<strong> Editeur : </strong>
				<?php echo utf8_encode($editeur); ?>
			<br/>
			<br/>
				<strong> Résumé : </strong>
				<?php echo utf8_encode($descriptions); ?>
			<br />
			<br />
				<strong> Disponibilité : </strong>
				<?php 
					if ($emprunt == 1) {
						echo "<span style='text-decoration:blink;color:green;'> DISPONIBLE </span>";
					}else {
						echo "<span style='text-decoration:blink;color:red;'> NON DISPONIBLE </span>";
					}
				?>
			</p>
		</div>
	</div>
</body>
</html>
