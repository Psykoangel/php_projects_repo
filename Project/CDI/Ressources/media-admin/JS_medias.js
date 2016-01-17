/*
********* PROJET CDI **********

******JS MEDIA - ADD INPUT *****

Description :Ce fichier JavaScript va ajouter un ou plusieurs input de type 
texte au formulaire auquel il est rattaché 

NB : FONCTION JS PURE, AUCUNE GENERATION PHP 

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/
// Créations de variables gloables 
var auteur_i = 1;
var editeur_i = 1;

// Fonction ajout pour auteur 
function ajoutAuteur()
{
	auteur_i ++;
	var div = document.getElementById('auteursSup');
	
	var label = document.createTextNode('Auteurs ' +  auteur_i + ' : ');
	div.appendChild(label);
	
	var input = document.createElement('input');
	input.id ='auteur';
	input.setAttribute("onmouseout","VerifyAuteur(this)"); 
	div.appendChild(input);
	
	div.appendChild(document.createElement('br'));
}

// Fonction ajout pour Editeur 
function ajoutEditeur()
{
	editeur_i ++;
	var div = document.getElementById('editeursSup');
	
	var label = document.createTextNode('Editeurs ' +  editeur_i + ' : ');
	div.appendChild(label);
	
	var input = document.createElement('input');
	input.id = 'editeur';
	input.setAttribute("onmouseout","VerifyEditeurs(this)"); 
	div.appendChild(input);
	
	div.appendChild(document.createElement('br'));
}

