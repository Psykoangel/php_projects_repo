<?php
	
	/* -- Classe Sécurité -- */
	class Securite
	{
		// -- Entrée --
		static function bdd($string)
		{
			// Numérique entier --
			if(ctype_digit($string))
			{
				$string = intval($string);
			}
			// Textuel --
			else
			{
				$string = mysql_real_escape_string(utf8_decode($string));
				$string = addcslashes($string, '%_');
			}
			
			return $string;
		}

		// -- Sortie --
		static function html($string)
		{
			return htmlentities(stripslashes(utf8_encode($string)));
		}
		
		static function isInt($int)
		{
			return  intval($int) != 0;
		}
	}

	



