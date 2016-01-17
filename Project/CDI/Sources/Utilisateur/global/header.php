<ul class="nav">
	<li <?php if($data['page'] == "Sources/Utilisateur/accueil/vue.php") echo 'class="active"'; ?>><a href="?user"> Accueil </a></li>
	<li <?php if($data['page'] == "Sources/Utilisateur/catalogue/vue.php") echo 'class="active"'; ?>><a href="?user=catalogue"> Catalogue </a></li>
	<li <?php if($data['page'] == "Sources/Utilisateur/historique/vue.php") echo 'class="active"'; ?>><a href="?user=historique"> Historique </a></li>
	<li <?php if($data['page'] == "Sources/Utilisateur/contact/vue.php") echo 'class="active"'; ?>><a href="?user=contact"> Contact </a></li>
	<li <?php if($data['page'] == "Sources/Utilisateur/panier/vue.php") echo 'class="active"'; ?>><a href="?user=panier"> Panier </a></li>
	<li>
		<div id="InfoMembre" style="width: 330px; padding-top:10px; padding-left: 130px;">
			<span>Bonjour, <?php echo $visiteur['nom']; ?> !</span>
			<?php if(in_array('administrateur', $visiteur['droits']))
			{
			?>
			<a href="?admin">(Admin)</a>
			<?php    
			}
			?>
			<a href="?deco">(Deconnexion)</a>                
		</div>
	</li>
</ul>