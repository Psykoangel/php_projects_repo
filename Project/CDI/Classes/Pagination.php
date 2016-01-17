<?php 

class Pagination
{
	private $lien;
	private $nombre;
	private $pagination;
	
	function __construct($lien, $nombre = 0)
	{
		$this->lien = $lien;
		$this->nombre = $nombre;
	}
	
	function __toString()
	{
		global $data;
		
		if(empty($pagination))
		{
			$this->pagination = 'Page : 1';
			if($this->nombre > $data['pagination'])
			{
				$nombre_pages  = ceil($this->nombre / $data['pagination']);
				$this->pagination = 'Page : ';
				for ($i = 1; $i <= $nombre_pages ; $i++)
				{
					$this->pagination .= '<a href="'. $this->lien .'&amp;page='. $i .'">' . $i . '</a> ';
				}
			}
		}
		
		return $this->pagination;
	}
	
	function compter($requete, $donnees)
	{
		global $bdd;
		
		$requete =  $bdd->prepare('SELECT COUNT(*) AS nombre '. $requete);
		$requete->execute($donnees);
		$nombre = $requete->fetch();
		$this->nombre = $nombre['nombre'];
	}
	
	function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}
}