<div class="container">
	<h3>Historique de vos emprunts : </h3>
	<?php
	if(!empty($page['medias']))
	{
		foreach($page['medias'] as $media)
		{
	?>
			<!-- Main hero unit for a primary marketing message or call to action -->
                        
			<div class="page-header">
				<h4>Résumé du média : <?php echo $media['titre_media'] ?></h4>
				<h5> Date de réservation : </h5> <h6> <?php echo $media['debut_reservation']; ?> -> <?php echo $media['fin_reservation']; ?> </h6>
			</div>

		  <hr>
		</br>
	<?php
		}
	}
	else
	{
	?>
			<div class="row">
				<p> Aucun média dans l'historique ! </p>
			</div>
	<?php
	}
	?>
</div>
<!--    affichage de l'historique-->