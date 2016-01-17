<?php /* 

********* PROJET CDI **********

**********ADD_MEDIA **********

Description : Page PHP qui génère un formulaire HTML pour
ajouter un média dans la BDD. 
Page en PHP car il y'a des requires qui necessite traitement !

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/ ?>

<form class="Media" method=POST action="?admin=media&amp;action=ajouter" enctype="multipart/form-data">
	<h3> Ajouter un média </h3>
	<label for="Titre Média"> Titre Média : </label><input type="text" name="titre" class='InputText'/>            
	<label for="ISBN">ISBN : </label><input type="text" name="isbn" class='InputText' /> <br /> <br />
	<label for="Auteurs"><img src="<?php echo $page['path']; ?>imgP.png" id="imgAdd" onClick="ajoutAuteur();"/> Auteurs :  </label><input type="text" name="auteurs" id="auteur"  class='InputText' /> 
			<br /> <br /> <div id="auteursSup"></div>
	<label for="Editeurs"><img src="<?php echo $page['path']; ?>imgP.png" id="imgAdd" onClick="ajoutEditeur();"/> Editeurs :  </label><input type="text" name="editeurs" id="editeur"  class='InputText' />
			<br /> <br /> <div id="editeursSup"></div>
	<label for="Description">Description :  </label><TEXTAREA rows="3" name="resumeMedia"></TEXTAREA> <br /> <br />
	<label for="Type">Type  :  </label><SELECT name="Type"class='InputText' >
					<OPTION VALUE="Livre">Livre</OPTION>
					<OPTION VALUE="CD/DVD">CD/DVD</OPTION>
					<OPTION VALUE="Magasine">Magasine</OPTION>
				</SELECT>
	<label for="Catégorie">Catégorie :  </label><SELECT name="Categorie"class='InputText'>
					<OPTION VALUE="Architecture des MI">Architecture des MI</OPTION>
					<OPTION VALUE="Langage C">Langage C</OPTION>
					<OPTION VALUE="Langage C #">Langage C #</OPTION>
					<OPTION VALUE="Langage C ++">Langage C ++</OPTION>
					<OPTION VALUE="Réseau">Réseau</OPTION>
					<OPTION VALUE="Logiciel">Logiciel</OPTION>
				</SELECT><br /><br />
	<label for="Empruntable">Empruntable :  </label> <input type="checkbox" name="emprunt" id="emprunt" /> <br /> <br />
	<label for="img">Image :  </label> <input type="file" name="img" /> <br /> <br />
	<input type="submit" value="Enregistrer" id="submit"> 
</form>
	
