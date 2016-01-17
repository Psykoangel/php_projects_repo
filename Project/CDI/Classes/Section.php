<?php

	/* -- Page -- */
	class Page
	{
		private $id;
		private $section;
		
		public function __construct($section, $id)
		{
			$this->section = $section;
			$this->id = $id;
		}
		
		function getId()	{ return $this->id;	}
		function setId($valeur) { $this->id = $valeur;	}
		
		function &setPageParDefaut() { $this->section->setPageParDefaut($this->id); return $this;}
		
	}
	
	/* -- Liste de pages -- */
	class Section
	{
		private $liste;
		private $droits;
		private $id;
		private $get;
		private $pageParDefaut;
		
		function __construct($id, $get, $droits = false)
		{
			$this->liste = array();
			$this->droits = $droits;
			$this->id = $id; 
			$this->get = $get; 
		}

		function add($id)
		{
			$nouveau = new Page($this, $id);
			array_push($this->liste, $nouveau);
			
			//echo '<pre>';print_r($this);echo '</pre>';
			return $nouveau;
		}
		
		function setPageParDefaut($valeur) 
		{ 
			$this->pageParDefaut = $valeur;
		}
		function getPageParDefaut()	{ return $this->pageParDefaut;	}

		// -- Tests --
		function permitted($droits)
		{
			return (!empty($this->droits)) ? in_array($this->droits, $droits) : true;
		}
		
		function requested()
		{
			return array_key_exists($this->get, $_GET);
		}
		
		function page_exists($id_page)
		{
			$retour = false;
			foreach($this->liste as $page) { if($page->getId() == $id_page) $retour = true; }
			return $retour;
		}
		
		// -- Sortie --	
		function getId() { return $this->id;	}
		function getRequestedPage()	
		{
			// -- Par défaut --
			$retour = $this->pageParDefaut;
			
			if(isset($_GET[$this->get]) && !empty($_GET[$this->get]))
			{
				foreach ($this->liste as $page)
				{
					if($_GET[$this->get] == $page->getId() && $this->page_exists($page->getId()))
					{
						$retour = $page->getId();
					}
				}
			}
			
			return $retour;
		}
		
	}

	



