<!--<ul>
    <?php /*foreach($page['medias'] as $media) $media->affichage(); */?>
</ul>
<div id="dial" style="display:none"></div>-->
<div
	class="container">

	<!-- Main hero unit for a primary marketing message or call to action -->
	<div class="page-header">
		<h1>
			Catalogue <br /> <small>Terminée le temps où vous vous rendiez au
				CDI. Désormais, c'est lui vient vers vous ! </small>
		</h1>
	</div>
	<!-- Example row of columns -->
	<div class="row">
		<div class="span12">
			<h2>
				<i class="icon-pencil"></i>Médias
			</h2>
			<div style="background-color: #c73e38; color: #ffffff;">
				<?php
				if($errorNumber != 0)
				{
					if ($errorNumber == 100)
					{
						?>
				<p>Vous ne pouvez pas commander plus de trois livres en même temps
					!</p>
				<?php
					}
				}
				?>
			</div>

			<script type="text/javascript"
				src="Ressources/global-user/jQuery-jKit-master/jquery-1.8.2.min.js"></script>
			<script type="text/javascript"
				src="Ressources/global-user/jQuery-jKit-master/jquery.jkit.1.1.10.min.js"></script>


			<script type="text/javascript">
						$(document).ready(function(){
							$('body').jKit();
						});
						</script>

			<div class="box" data-jkit="[filter:by=class;affected=ul > div]">
				<select class="jkit-filter">
					<option value="">Tous</option>
					<option value="Livre">Livre</option>
					<option value="CD/DVD">CD/DVD</option>
					<option value="Magasine">Magasine</option>
				</select> <select class="jkit-filter">
					<option value="" selected>Tous</option>
					<option value="Architecture des MI">Architecture des MI</option>
					<option value="Langage C">Langage C</option>
					<option value="Langage C ++">Langage C ++</option>
					<option value="Langage C #">Langage C #</option>
					<option value="Réseau">Réseau</option>
					<option value="Logiciel">Logiciel</option>
				</select>
				<form method=POST action="?user=panier">
					<ul class="thumbnails" style="min-height: 307px;">
						<?php
						$cpt=0;
						foreach($donnees as $donnee)
						{

							// Req Type
							$reqtype = $bdd->query("SELECT nom_type FROM types WHERE id_type=".$donnee['id_type'].";");
							$type = "";
							$donnees3 = $reqtype->fetchAll();
							foreach ($donnees3 as $donnee3)
							{
								$type .= $donnee3['nom_type'];
							}
							// Req catégorie
							$reqcat = $bdd->query("SELECT nom_categorie FROM categories WHERE id_categorie=".$donnee['id_categorie'].";");
							$categorie = "";
							$donnees4 = $reqcat->fetchAll();
							foreach ($donnees4 as $donnee4)
							{
								$categorie .= $donnee4['nom_categorie'];
							}
							echo '<div class="'.utf8_encode($type).' '.utf8_encode($categorie).'">';
							echo'<li class="span3" style ="margin-top:20px;">
						<div class="thumbnail"  style="min-height:307px;">';
							$titre = $donnee['titre_media'];
							$image = $donnee['nom_image'];
							if (empty($image) || !isset($image)) $image = 'no_image.jpg';
							// Req Auteur
							$reqAut = $bdd->query("SELECT nom_auteur FROM auteurs INNER JOIN ecrire ON ecrire.id_auteur = auteurs.id_auteur WHERE ecrire.id_media =".$donnee['id_media'].";");
							$autors = "";
							$donnees2 = $reqAut->fetchAll();
							foreach ($donnees2 as $donnee2)
							{
								$autors .= $donnee2['nom_auteur'].'/';
							}
							// Req Editeur
							$reqEdit = $bdd->query("SELECT nom_editeur FROM editeurs INNER JOIN publier ON publier.id_editeur = editeurs.id_editeur WHERE publier.id_media =".$donnee['id_media'].";");
							$editors = "";
							$donnees3 = $reqEdit->fetchAll();
							foreach ($donnees3 as $donnee3)
							{
								$editors .= utf8_encode($donnee3['nom_editeur']).'/';
							}
							// Remplissage
							echo '<link rel="stylesheet" href="Ressources/global-user/lightbox.css"/>';
							echo '<a href="Ressources/global-user/info.php?id_media='.$donnee['id_media'].'&auteur='.$autors.'&editeur='.$editors.'" data-jkit="[lightbox]" title="'.$titre.'"> <img src="Ressources/images/miniatures/'.$image.'" alt=""/></a>';
							echo '<h3>'.$donnee['titre_media'].'</h3>';
							echo '<p> Auteur : '.$autors.' <br/> Editeur : '.$editors.'</p>';
							$reqExemp = $bdd->query("SELECT COUNT(*) AS cpt FROM exemplaires WHERE id_media=".$donnee['id_media']." AND dispo_exemplaire=1");
							$tempCount = $reqExemp->fetch();
                                                        if (!(isset($_SESSION['panier']))) $_SESSION['panier'] = array();
							if (intval($tempCount['cpt']) < 1 || intval(count($_SESSION['panier']) >= 3)) $disabled = "disabled='disabled' title='Indisponible momentan�ment'";
                                                        else $disabled = "";
                                                            echo '<input name="mediaList[]" type="checkbox" value='.$donnee['id_media'].' '.(!empty($disabled) ? $disabled : '').'>';
                                                            echo '</div></li></div>';

							if ($cpt == 7) {
								echo '<div class="span12" style="margin-top:10px;"><button type="submit" class="btn btn-large btn-block btn-primary">Enregistrer
									dans le panier</button></div>';
								$cpt=0;
							} else {
								$cpt++;
							}
						}
							
						?>
					</ul>
					<button type="submit" class="btn btn-large btn-block btn-primary">Enregistrer
						dans le panier</button>
				</form>
				</ul>
			</div>
		</div>

		<hr>
	</div>