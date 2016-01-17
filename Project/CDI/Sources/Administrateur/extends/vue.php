<h1>Liste des <?php echo $page['nomExt']; ?></h1>
<a href="<?php echo $page['url']; ?>&amp;ajouter">Ajouter</a><br/>

<?php if($page['form']) { ?><!-- Formulaire -->
<form method="post" action="<?php 
		echo $page['url']. '&amp;'. $page['keyAction'];
		if($page['keyAction'] == 'editer') echo '=' . $page['id_ext']; 
	?>">
   <fieldset>
		<legend><?php echo $page['action']; ?></legend> <!-- Titre du fieldset --> 
		<?php if(isset($page['formErreur'])) { ?>
			<div class="message_erreur"><?php echo $page['formErreur']; ?></div>
		<?php } else if(isset($page['formInfo'])) { ?>
			<div class="message_info"><?php echo $page['formInfo']; ?></div>
		<?php } if($page['formInput']) { ?>
			<label for="nom">Nom : </label>
			<input type="text" name="nom" id="nom" <?php
				if($page['keyAction'] == 'editer') echo ' value="'. $page['formElement']['nom'] .'" ';
			?>/><br/>

			<?php if(isset($page['exception']) && $page['exception'] == 'type') { ?>
				<label for="duree">Durée</label>
				<input type="number" name="duree" id="duree" <?php
				if($page['keyAction'] == 'editer') echo ' value="'. $page['formElement']['duree'] .'" ';
			?>/><br/>
		<?php } ?>
		<input type="submit" value="envoyer"/>
		<?php } ?>
   </fieldset>
</form>
<?php } if(!empty($page['liste'])) { ?><!-- liste -->
<table>
	<thead>
		<tr><!-- Pagination -->
			<td colspan="<?php echo $page['colonnes']; ?>"><?php echo $page['pagination']; ?></td>
		</tr>
		<tr><!-- Entête -->
			<th>Nom</th>
			<?php if($page['cible']) { ?><!-- Base renseignée -->
				<th width="40">Délier</th>
			<?php } ?>
			<th width="40">Editer</th>
			<th width="40">Supprimer</th>
		</tr>
	</thead>
	<tfoot>
		<tr><!-- Pagination -->
			<td colspan="<?php $page['colonnes']; ?>"><?php echo $page['pagination']; ?></td>
		</tr>
	</tfoot>
	<tbody>
		<?php foreach($page['liste'] as $element) { ?>
		<tr>
			<td><?php echo Securite::html($element['nom']); ?></td>
			<?php if($page['cible']) { ?><!-- Base renseignée -->
				<td><a href="<?php echo $page['url'] . '&amp;delier='. $element['id']; ?>">délier</a></td>
			<?php } ?>
			<td><a href="<?php echo $page['url'] . '&amp;editer='. $element['id']; ?>">éditer</a></td>
			<td><a href="<?php echo $page['url'] . '&amp;supprimer='. $element['id']; ?>">supprimer</a></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php } ?>