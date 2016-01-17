<?php

	global $bdd;
		
	try 
	{ 
		$bdd = new PDO('mysql:host=localhost;dbname=projet_cdi', 'root', ''); 
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}
	catch (Exception $e) { die('Erreur BDD : ' . $e->getMessage()); }
		
	// ---------------------

	class GenSingleExtends
	{
		private $sb;
		private $se;
		
		private $tb;
		private $te;
		
		private $nom;
		
		function __construct($suf_extend, $tab_extend, $suf_base, $tab_base)
		{
			$this->se = $suf_extend;
			$this->te = $tab_extend;
			
			$this->sb = $suf_base;
			$this->tb = $tab_base;
		}
		
		function ajouter($nom, $exception)
		{
			global $bdd;
			$bdd->beginTransaction();
			
			$ajustement = '';
			if($exception != -1) 
			{
				$ajustement_part1 = ', duree_type'; 
				$ajustement_part2 = ', :duree';
			}
			
			// Ajout de l'extension --
			$requete = $bdd->prepare('INSERT INTO '. $this->te .'(nom'. $this->se . $ajustement_part1 .') VALUES(:nom'
				. $ajustement_part2 . ')');
			$requete->bindParam(':nom', $nom, PDO::PARAM_STR);
			if($exception != -1) $requete->bindParam(':duree', $exception, PDO::PARAM_STR);
			$requete->execute();
			
			$bdd->commit();
		}
		
		function editer($nom, $id, $exception = -1)
		{
			global $bdd;
			$bdd->beginTransaction();
			
			$ajustement = '';
			if($exception != -1) 
			{
				$ajustement = ', duree_type = '. intval($exception);
			}
			
			// Edition de l'extension --
			$requete = $bdd->prepare('UPDATE '. $this->te .' SET nom'. $this->se .' = :nom'. $ajustement
				.' WHERE id'. $this->se .' = :id');
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->bindParam(':nom', $nom, PDO::PARAM_STR);
			$requete->execute();
			
			$bdd->commit();
		}
		
		function supprimer($nom)
		{
			global $bdd;
			$bdd->beginTransaction();
			
			// Récupérer l'id de l'extension --
			$requete = $bdd->prepare('SELECT e.id'. $this->se .' AS id FROM '. $this->te . ' e WHERE nom'. $this->se .' = :nom');
			$requete->bindParam(':nom', $nom, PDO::PARAM_STR);
			$requete->execute();
			$resultat = $requete->fetch(PDO::FETCH_ASSOC);
			$id = $resultat['id'];
			
			// Suppression de l'extension --
			$bdd->prepare('DELETE FROM '. $this->te .' WHERE id'. $this->se .' = :id');
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			
			$bdd->commit();
		}
		
		function getAll($exception = -1)
		{
			global $bdd;
			
			$exception = ($exception != -1) ? ', duree_type AS duree' : '' ;
			
			// -- Récupération --
			$requete = $bdd->prepare('SELECT e.id'. $this->se .' AS id, e.nom'. $this->se .' AS nom '. $exception
				.' FROM '. $this->te . ' e');
			$requete->execute();
			return $requete->fetchAll(PDO::FETCH_ASSOC);
		}
		
		function countAll()
		{
			global $bdd;
			
			// -- Récupération --
			$requete = $bdd->prepare('SELECT COUNT(*) AS nombre FROM '. $this->te . ' e');
			$requete->execute();
			$resultat = $requete->fetch(PDO::FETCH_ASSOC);
			return $resultat['nombre'];
		}
		
		function getByName($nom, $exception =-1)
		{
			global $bdd;
			
			$exception = ($exception != -1) ? ', duree_type AS duree' : '' ;
			
			// -- Récupération --
			$requete = $bdd->prepare('SELECT id'. $this->se .' AS id, nom'. $this->se .' AS nom '. $exception
				.' FROM '. $this->te . ' e'
								. 'WHERE nom'. $this->se .' = :nom');
			$requete->bindParam(':nom', $nom, PDO::PARAM_STR);
			$requete->execute();
			return $requete->fetch(PDO::FETCH_ASSOC);
		}
		
		function getById($id, $exception =-1)
		{
			global $bdd;
			
			$exception = ($exception != -1) ? ', duree_type AS duree' : '' ;
			
			// -- Récupération --
			$requete = $bdd->prepare('SELECT id'. $this->se .' AS id, nom'. $this->se .' AS nom '. $exception
				.' FROM '. $this->te . ' e'
								. ' WHERE id'. $this->se .' = :id');
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			return $requete->fetch(PDO::FETCH_ASSOC);
		}
		
		function parentExists($id)
		{
			global $bdd;
			
			// -- Récupération --
			$requete = $bdd->prepare('SELECT COUNT(*) AS nombre FROM '. $this->tb . ' b'
								. 'WHERE id'. $this->sb .' = :id');
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			$resultat = $requete->fetch(PDO::FETCH_ASSOC);
			return ($resultat['nombre'] == 1) ? true : false ;
		}
	}
	
?>