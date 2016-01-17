<?php

	// -- Barre de navigation --

	class ElementNavigateur
	{
		private $adresse;
		private $etiquette;
		
		public function __construct($adresse, $etiquette)
		{
			$this->adresse = $adresse;
			$this->etiquette = $etiquette;
		}
		
		public function __toString()
		{
			return '<a href="'. $this->adresse .'">'. $this->etiquette .'</a>';
		
		}
		
	}
	
	class Navigateur
	{
		private $listeElements;
		private $i;
		
		public function __construct()
		{
			$this->listeElements = array();
			$this->i = 0;
		}
		
		public function add($adresse, $etiquette)
		{
			$element = new ElementNavigateur($adresse, $etiquette);
			$this->listeElements[$this->i] = $element;
			$this->i += 1;
		}
		
		public function __toString()
		{
			$reponse = "";
			$i = 0;
			
			if($this->i > 0)
			{
				foreach($this->listeElements as $element)
				{
					if($i > 0) $reponse .= " > ";
					$reponse .= $element;
					$i++;
				}
			}
			return $reponse;
		}
	}