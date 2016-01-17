/* Mise ‡ jour du formulaire d'inscription */
function maj(form)
{
	var red = "#f04345";
	var green = "#4ed27a";
	var mail = document.getElementById("envoyer");
	var regNom = /^[a-zA-ZÈË‡Í®Î-]{2,}$/;
	var regMail = /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/;
	var valide = true;
	
	/* Reinitialisation */
	mail.href="#";
	
	/* Tests */
	if(!regNom.test(form.prenom.value))
	{
		if(form.prenom.value.length != 0) form.prenom.style.backgroundColor = red;
		else form.prenom.style.backgroundColor = green;
		valide = false;
	}
	else { form.prenom.style.backgroundColor = green; }
	
	if(!regNom.test(form.nom.value))
	{
		if(form.nom.value.length != 0) form.nom.style.backgroundColor = red;
		else form.nom.style.backgroundColor = green;
		valide = false;
	}
	else { form.nom.style.backgroundColor = green; }
	
	if(!regMail.test(form.mail.value))
	{
		if(form.mail.value.length != 0) form.mail.style.backgroundColor = red;
		else form.mail.style.backgroundColor = green;
		valide = false;
	}
	else { form.mail.style.backgroundColor = green; }
	
	if(form.mail.value != form.conf_mail.value)
	{
		if(form.conf_mail.value.length != 0) form.conf_mail.style.backgroundColor = red;
		else form.conf_mail.style.backgroundColor = green;
	}
	else if(valide == true)
	{
		form.conf_mail.style.backgroundColor = green;
		
		mail.href = "mailto:mkister@cesi.fr?subject=Inscription&cc=" + form.mail.value;
		mail.href += "&body=Bonjour,%0A%0AJe me nomme " + form.prenom.value + " " + form.nom.value;
		mail.href += " et je souhaite participer aux evenements :%0A"
		
		if(form.ev1.checked == true) mail.href += "- Conference HTML%0A";
		if(form.ev2.checked == true) mail.href += "- Conference CSS%0A";
		if(form.ev3.checked == true) mail.href += "- Conference JS%0A";
		if(form.ev4.checked == true) mail.href += "- Conference PHP-1%0A";
		if(form.ev5.checked == true) mail.href += "- Conference PHP-2%0A";
		
		if(form.repas1.checked == true) mail.href += "- Repas du Mardi (gratuit)%0A";
		if(form.repas2.checked == true) mail.href += "- Repas du Mercredi (gratuit)%0A";
		
		mail.href += "%0AMerci ‡ vous et bonne journÈe,%0AGroupe Cesi"
	}
}

function halfday(link)
{
	while(link.nextSibling)
	{
		link = link.nextSibling;
		if(/^ev/.test(link.name))
		{
			link.checked="on";
		}
	}
}

function repas(link)
{
	var elements = link.parentNode.childNodes;
	var actif=true;
	var repas;
	
			
	for(var i = 0; i < elements.length; i++)
	{
		if(/^ev/.test(elements[i].name))
		{
			if(elements[i].checked != true) actif = false;
		}
		
		if(/^repas/.test(elements[i].id))
		{
			repas = elements[i];
		}
	}
	
	if(repas)
	{
		repas.style.display = (actif) ? "block" : "none";
		
		var cb = repas.firstChild;
		if(cb.tagName != "INPUT") cb = cb.nextSibling;
		cb.checked = false;
		
	}
}
