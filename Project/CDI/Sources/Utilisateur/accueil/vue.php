
<div
	class="container">
	<h1>Cesi-Media : CDI du Cesi Strasbourg</h1>
	
	<div class="hero-unit">
		<h2>Ajouts récents</h2>
		<?php
		foreach($donnees as $donnee) {
			echo '<div class="5M" style="width:200px;margin-right:10px; height:180px; display:inline-block; vertical-align:top;"><p>'.$donnee['titre_media'].'</p>';
			echo '<img src="Ressources/images/miniatures/'.$donnee['nom_image'].'">';
			echo '</div>';
			}
			?>
	</div>
	
	<!-- Example row of columns -->
	<div class="row">
		<div class="span4">
			<h2>Consultez</h2>
			<p>Grace à ce nouvel outil mis à votre disposition, vous pourrez
				savoir à tout moment quels sont les différents médias disponible
				dans le Centre de Documentation et D'information de l'eXia.Cesi de
				Strasbourg. De plus, grace à un système de filtre en Javascript,
				vous pourrez affiner vos recherche pour trouver votre média favoris.
			</p>

		</div>
		<div class="span4">
			<h2>
				<i class="icon-pencil"></i>Choisissez
			</h2>
			<p>Une fois que vous avez trouvé les médias dont vous avez besoin,
				vous pouvez les ajouter à votre panier si vous disposez d'un compte.
				Si vous n'avez pas de compte, veuillez contacter l'administrateur
				actuel du CDI afin de pouvoir commander vos médias.</p>

		</div>
		<div class="span4">
			<h2>Réservez</h2>
			<p>Une fois que vous avez choisis et valider votre commande,
				l'administrateur va prendre connaissance de votre choix. Il va
				chercher les premiers exemplaires disponible et préparer votre
				commande. Une fois que cette dérnière sera prête, vous recevrez un
				mail pour venir récupérer vos médias.</p>

		</div>
		
		<!-- Main hero unit for a primary marketing message or call to action -->
	
	
	</div>

	
	<hr>
</div>
