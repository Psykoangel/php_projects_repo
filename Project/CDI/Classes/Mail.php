<?php
	
	/* -- Classe de Mailing -- */
	class Mail
	{
		private $from;
		private $to;
		private $message;
		private $passage_ligne;
		
		function __construct()
		{
		}
		
		function setFrom($mail, $nom)
		{
			if (!preg_match("#^[a-z0-9._-]+@[a-zA-Z0-9.-]+.[a-z]{2,4}$#", $mail)) 
				echo 'Adresse mail invalide !';
			
			$this->from = '\"'. $nom .'\"<'. $mail .'>';
		}
		
		function setTo($mail, $nom)
		{
			if (!preg_match("#^[a-z0-9._-]+@[a-zA-Z0-9.-]+.[a-z]{2,4}$#", $mail)) 
				echo 'Adresse mail invalide !';
			
			// Vérification : Filtrage des serveurs atypiques --
			if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
				$passage_ligne = "\r\n";
			else
				$passage_ligne = "\n";
						
			$this->to = '\"'. $nom .'\"<'. $mail .'>';
		}
		
		function setMessage($mail)
		{
			$this->message = Securite::html($mail);
		}
		
		function envoyer()
		{
			// -- Initialisation --
			
				// Passage à la ligne --
				$passage_ligne = $this->passage_ligne;
				
				// Boundary --
				$boundary = "-----=".md5(rand());
				$boundary_line = $passage_ligne."--".$boundary.$passage_ligne;
				
				//	Contenu TXT/HTML --
				$message_txt = $this->message;
				$message_html = $this->message;
			 
				// Sujet --
				$sujet = "Hey mon ami !";
			
				// Header --
				$header = "From: \"". $this->from .$passage_ligne;
				$header.= "Reply-to: \"". $this->from .$passage_ligne;
				$header.= "MIME-Version: 1.0".$passage_ligne;
				$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
			 
			// -- Construction --
			 
				$message = $boundary_line;
				
				// Message au format TXT --
				$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
				$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
				$message.= $passage_ligne.$message_txt.$passage_ligne;
				
				$message.= $boundary_line;
				
				// Message au format HTML --
				$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
				$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
				$message.= $passage_ligne.$message_html.$passage_ligne;
				
				$message.= $boundary_line . $boundary_line;
			 
			// Envoi de l'e-mail --
			//mail($this->to,$sujet,$message,$header);
		}
	}

	



