<!--<ul>
    <?php /*foreach($page['medias'] as $media) $media->affichage(); */?>
</ul>
<div id="dial" style="display:none"></div>-->
    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
        <div class="page-header">
			<h1>Catalogue <br />
			<small>Terminée le temps où vous vous rendiez au CDI. Désormais, c'est lui vient vers vous ! </small></h1>
		</div>
	<hr><hr>
      <!-- Example row of columns -->
		<div class="row">
			<div class="span4">
			  <h2>Filtre JS</h2>
			  <p>A venir  </p>
			  <p><a class="btn" href="#">View details &raquo;</a></p>
			</div>
			<div class="span8">
			  <h2><i class="icon-pencil"></i>Médias</h2>
                          <div style="background-color: #c73e38; color: #ffffff;">
                          <?php
                          if($errorNumber != 0)
                          {
                              if ($errorNumber == 100)
                              {
                          ?>
                                  <p>Vous ne pouvez pas commander plus de trois livres en même temps !</p>
                          <?php
                              }
                          }
                          ?>
                          </div>
			  <form method=POST action="?user=panier">
				<table class="table table-condensed table-striped">
				  <thead>
					<tr>
							<th> </th>
							<th>Titre du média </th>
							<th>Auteur </th>
							<th>Editeur </th>
							<th>Type  </th>
							<th>Catégorie  </th>
							<th>Résumé  </th>
						</tr>
					</thead>
					<tbody>
						<tr>
                                                <?php
                                                foreach($donnees as $donnee)
                                                {
                                                    if (intval($donnee['dispo_exemplaire']) < 1) $disabled = "disabled='disabled' title='Indisponible momentanément'";
                                                    else $disabled = "";
                                                    echo '<tr>';
                                                    echo '<td> <input name="mediaList[]" type="checkbox" value='.$donnee['id_media'].' '.(!empty($disabled) ? $disabled : '').'></td>';
                                                    echo '<td>'.$donnee['titre_media'].'</td>';
                                                    $reqAut = $bdd->query("SELECT nom_auteur FROM auteurs INNER JOIN ecrire ON ecrire.id_auteur = auteurs.id_auteur WHERE ecrire.id_media =".$donnee['id_media'].";");
                                                    $autors = "";
                                                    $donnees2 = $reqAut->fetchAll();
                                                    foreach ($donnees2 as $donnee2)
                                                    {
                                                            $autors .= $donnee2['nom_auteur'].'/';
                                                    }
                                                    echo '<td>'.$autors.'</td>';
                                                    $reqEdit = $bdd->query("SELECT nom_editeur FROM editeurs INNER JOIN publier ON publier.id_editeur = editeurs.id_editeur WHERE publier.id_media =".$donnee['id_media'].";");
                                                    $editors = "";
                                                    $donnees3 = $reqEdit->fetchAll();
                                                    foreach ($donnees3 as $donnee3)
                                                    {
                                                            $editors .= utf8_encode($donnee3['nom_editeur']).'/';
                                                    }
                                                    echo '<td>'.$editors.'</td>';
                                                    echo '<td>'.$donnee['id_type'].'</td>';
                                                    echo '<td>'.$donnee['id_categorie'].'</td>';
                                                    $resume = utf8_encode($donnee['resume_media']);
                                                    echo '<td>'.substr($resume,0,30).' ... <a class="btn " href="info.php?id='.$donnee['id_media'].'"> En savoir plus </a></td>';
                                                    echo '</tr>';
                                                }
                                                ?>
				  </tbody>
				</table>
                                    <button type="submit" class="btn btn-large btn-block btn-primary" >Enregistrer dans le panier</button>
				</form>
		   </div>
		</div>

      <hr>
	</div>