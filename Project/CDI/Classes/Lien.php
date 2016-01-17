<?php
	
	/* -- Lien pour CSS -- */
	class LienCSS
	{
		private $liste;
		
		public function __construct()
		{
			$this->liste = array();
		}

		public function add($pack, $href, $titre = 'Defaut', $media = 'screen', $autre='')
		{
			$nouveau = array(
				"pack" => $pack,
				"href" => $href,
				"titre" => $titre,
				"media" => $media,
				"autre" => $autre
			);
			
			array_push($this->liste, $nouveau);
		}
		
		public function __toString()
		{
			global $path;
			$retour = '';
			
			foreach($this->liste as $lien)
			{
				$retour .= '<link rel="stylesheet" href="'. $path['ressources'] . $lien['pack'] .'/'. $lien['href'];
				$retour .= '" type="text/css" media="'. $lien['media'] .'" '. $lien['autre'] .'charset="utf-8"/>';
			}
			
			return $retour;
		}
	}
	
	class LienJS
	{
		private $liste;
		
		public function __construct()
		{
			$this->liste = array();
		}

		public function add($pack, $href, $script = '')
		{
			global $path;
			
			$src = (!empty($pack) && !empty($href)) ? $path['ressources'] . $pack .'/'. $href : '';
			
			$nouveau = array(
				"src" => $src,
				"script" => $script
			);
			
			array_push($this->liste, $nouveau);
		}
		
		public function addScript($script)
		{
			$this->add('', '', $script);
		}
		
		public function __toString()
		{
			$retour = '';
			
			foreach($this->liste as $lien)
			{
				$retour .= '<script';
				if(!empty($lien['src'])) $retour .= ' src="'. $lien['src'] .'" ';
				$retour .= '>';
				if(!empty($lien['script'])) $retour .= '<!-- '. $lien['script'] .' //-->';
				$retour .= '</script>';
			}
			
			return $retour;
		}
	}

	



