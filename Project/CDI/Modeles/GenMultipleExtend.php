<?php

	global $bdd;
		
	try 
	{ 
		$bdd = new PDO('mysql:host=localhost;dbname=projet_cdi', 'root', ''); 
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}
	catch (Exception $e) { die('Erreur BDD : ' . $e->getMessage()); }
		
	// ---------------------

	class GenMultipleExtends
	{
		private $sb;
		private $se;
		
		private $tb;
		private $tl;
		private $te;
		
		private $nom;
		
		function __construct($suf_base, $suf_extend, $tab_base, $tab_lien, $tab_extend)
		{
			$this->sb = $suf_base;
			$this->se = $suf_extend;
			
			$this->tb = $tab_base;
			$this->tl = $tab_lien;
			$this->te = $tab_extend;
			
			// -- Cas particulier --
			$this->nom = (($tab_extend != "Keywords") ? "nom" : "mot") . $this->se; 
		}
		
		// -- Entrée -- 
		
		function ajouter($nom, $id = -1, $exception = -1)
		{
			global $bdd;
			$bdd->beginTransaction();
			// Ajout de l'extension --
			$requete = $bdd->prepare('INSERT INTO '. $this->te .'('. $this->nom .') VALUES(:nom)');
			$requete->bindParam(':nom', $nom, PDO::PARAM_STR);
			$requete->execute();
			
			if($id != -1)
			{
				// Ajout du lien --
				$requete = $bdd->prepare('INSERT INTO '. $this->tl .'(id'. $this->sb .', id'. $this->se .') VALUES(:id, LAST_INSERT_ID())');
				$requete->bindParam(':id', $id, PDO::PARAM_INT);
				$requete->execute();
			}
			
			$bdd->commit();
		}
		
		function editer($nom, $id, $exception = -1)
		{
			global $bdd;
			$bdd->beginTransaction();
			
			// Edition de l'extension --
			$requete = $bdd->prepare('UPDATE '. $this->te .' SET '. $this->nom .' = :nom WHERE id'. $this->se .' = :id');
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->bindParam(':nom', $nom, PDO::PARAM_STR);
			$requete->execute();
			
			$bdd->commit();
		}
		
		function supprimer($id)
		{
			global $bdd;
			$bdd->beginTransaction();
			
			// Suppression du lien --
			$requete = $bdd->prepare('DELETE FROM '. $this->tl .' WHERE id'. $this->se .' = :id');
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			
			// Suppression de l'extension --
			$requete = $bdd->prepare('DELETE FROM '. $this->te .' WHERE id'. $this->se .' = :id');
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			
			$bdd->commit();
		}
		
		function lier($id_e, $id_b)
		{
			global $bdd;
			$bdd->beginTransaction();
			
			// Ajout du lien --
			$requete = $bdd->prepare('INSERT INTO '. $this->tl .'(id'. $this->tb .', id'. $this->te .') VALUES(:id_b, :id_e)');
			$requete->bindParam(':id_e', $id_e, PDO::PARAM_INT);
			$requete->bindParam(':id_b ', $id_b, PDO::PARAM_INT);
			$requete->execute();
			
			$bdd->commit();
		}
		
		function delier($id_e, $id_b)
		{
			global $bdd;
			
			// Ajout du lien --
			$requete = $bdd->prepare('DELETE FROM '. $this->tl .' WHERE id'. $this->se .' = :ext AND id'. $this->sb .' = :tab');
			$requete->execute(array(':ext'=> intval($id_e), ':tab' => intval($id_b)));
		}
		
		// -- Sortie -- 
		
		function getAll($id = -1, $exception = -1)
		{
			global $bdd;
			
			// -- Par ID / Tous --
			$condition = ($id != -1) ? ' INNER JOIN '. $this->tl . ' l ON e.id'. $this->se .' = l.id'. $this->se .
				' WHERE id'. $this->sb .' = :id' : '';
			
			// -- Récupération --
			$requete = $bdd->prepare('SELECT e.id'. $this->se .' AS id, e.'. $this->nom .' AS nom FROM '. $this->te . ' e'. $condition);
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			return $requete->fetchAll(PDO::FETCH_ASSOC);
		}
		
		function getById($id, $exception = -1)
		{
			global $bdd;
			
			// -- Récupération --
			$requete = $bdd->prepare('SELECT id'. $this->se .' AS id, '. $this->nom .' AS nom FROM '. $this->te
								. ' WHERE id'. $this->se .' = :id');
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			return $requete->fetch(PDO::FETCH_ASSOC);
		}
		
		function countAll($id = -1)
		{
			global $bdd;
			
			// -- Par ID / Tous --			
			$condition = ($id != -1) ? ' WHERE id'. $this->sb .' = :id' : '';
			
			// -- Récupération --
			$requete = $bdd->prepare('SELECT COUNT(*) AS nombre FROM '. $this->te . ' e'
										. ' INNER JOIN '. $this->tl . ' l ON e.id'. $this->se .' = l.id'. $this->se 										
										. $condition);
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			$resultat = $requete->fetch(PDO::FETCH_ASSOC);
			return $resultat['nombre'];
		}
		
		function parentExists($id)
		{
			global $bdd;
			
			// -- Récupération --
			$requete = $bdd->prepare('SELECT COUNT(*) AS nombre FROM '. $this->tb . ' b'
								. ' WHERE id'. $this->sb .' = :id');
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			$resultat = $requete->fetch(PDO::FETCH_ASSOC);
			return ($resultat['nombre'] == 1) ? true : false ;
		}
	}
	
	
	
?>