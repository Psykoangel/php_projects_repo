<?php
	
	/* -- Modèle média -- */
	
	class SearchMedia
	{
		function __construct()
		{
			$this->free = false;
		}
		
		private $titre;
		function setTitre($valeur) { $this->titre = $valeur; }		
		
		private $type;
		function setType($valeur) { $this->categorie = $valeur; }
		
		private $categorie;
		function setCategorie($valeur) { $this->categorie = $valeur; }
		
		private $free;
		function setFree($valeur) { $this->free = $valeur; }
		private function getFree() { return ($this->free) ? ' AND dispo_exemplaire = true' : ''; }
		
		function getAll()
		{
                    global $bdd;

                    $condition = '';
                    if(!empty($this->titre))  $condition .= '';
                    if(Securite::isInt($this->type))  $condition .= 'AND id_type = :type';
                    if(Securite::isInt($this->categorie))  $condition .= 'AND id_categorie = :cat';

                    // -- Récupération --
                    $requete = $bdd->prepare("SELECT * FROM medias WHERE id_media IN (SELECT id_media FROM exemplaires WHERE num_exemplaire != ''". getFree() .") " . $condition);

                    if(!empty($this->titre))  $requete->bindParam(':titre', $this->titre, PDO::PARAM_INT);
                    if(Securite::isInt($this->type)) $requete->bindParam(':type', $this->type, PDO::PARAM_INT);
                    if(Securite::isInt($this->categorie)) $requete->bindParam(':cat', $this->categorie, PDO::PARAM_INT);

                    $requete->execute();
                    return $requete->fetchAll(PDO::FETCH_ASSOC);
		}
	}
	
	class ModelMedia
	{	
		// -- Récupération --
		static function getAll($id = -1)
		{
                    global $bdd;

                    $condition = ($id != -1) ? ' WHERE id_media = :id ' : '';
                    $condition .= (true) ? ($id == -1) ? ' WHERE ' : ' AND ' : '';
                    $condition .= (true) ? "id_media IN (SELECT id_media FROM exemplaires WHERE num_exemplaire != '' AND dispo_exemplaire = true)" : '';
                    $selecting = 'SELECT m.id_media, m.id_categorie, m.id_type, m.id_admin, m.titre_media, m.isbn_media, m.resume_media, m.empruntable_media, nom_categorie, nom_type, nom_admin ';
                    $joining = ' INNER JOIN categories ON categories.id_categorie=m.id_categorie'.
                               ' INNER JOIN types ON types.id_type=m.id_type'.
                               ' INNER JOIN administrateurs ON administrateurs.id_admin=m.id_admin';
                    // -- Récupération --
                    $requete = $bdd->prepare($selecting.'FROM medias m'.$joining. $condition);
                    if ($id != -1) $requete->bindParam(':id', $id, PDO::PARAM_INT);
                    $requete->execute();

                    $retour = array();			
                    while($entree = $requete->fetch(PDO::FETCH_ASSOC))
                    {
                        $nouveau = array();
                        foreach($entree as $cle => $element)
                        {
                            $nouveau[$cle] = Securite::html($element);
                        }
                        array_push($retour, $nouveau);
                    }
                    return $retour;
		}
		
		static function getByName($name)
		{
			global $bdd;
			
			// -- Récupération --
			$requete = $bdd->prepare('SELECT * FROM Medias m WHERE titre_media = :name');
			$requete->bindParam(':name', $name, PDO::PARAM_INT);
			$requete->execute();
			return $requete->fetch(PDO::FETCH_ASSOC);
		}
		
		static function getIdByName($name)
		{
			global $bdd;
			
			// -- Récupération --
			$requete = $bdd->prepare('SELECT id_media FROM medias WHERE titre_media = :name');
			$requete->bindParam(':name', $name, PDO::PARAM_INT);
			$requete->execute();
			$resultat = $requete->fetch(PDO::FETCH_ASSOC);
			return $resultat['id_media'];
		}
		
		static function getTrace($id)
		{
			global $bdd;
			
			// -- Récupération --
			$requete = $bdd->prepare('SELECT * FROM reservations r '. 
				' INNER JOIN Concerner c ON c.id_reservation = r.id_reservation'.
				' INNER JOIN Exemplaires e ON e.num_exemplaire = c.num_exemplaire'.
				' INNER JOIN Medias m ON e.id_media = m.id_media'.
				' WHERE r.id_admin = :id');
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			
			$retour = array();			
			while($entree = $requete->fetch(PDO::FETCH_ASSOC))
			{
				$nouveau = array();
				foreach($entree as $cle => $element)
				{
					$nouveau[$cle] = Securite::html($element);
				}
				array_push($retour, $nouveau);
			}
			return $retour;
		}
		
		// -- Récupération des derniers IDs --
		static function getLastReservationId()
		{
			global $bdd;
			
			// -- Récupération --
			$requete = $bdd->prepare('SELECT MAX(id_reservation) AS last FROM reservations');
			$requete->execute();
			$resultat = $requete->fetch(PDO::FETCH_ASSOC);
			return $resultat['last'];
		}
		
		static function getLastFreeMediaId($id)
		{
			global $bdd;
			
			// -- Récupération --
			$requete = $bdd->prepare('SELECT MAX(num_exemplaire) AS last FROM exemplaires WHERE id_media = :id AND dispo_exemplaire = true;');
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			$resultat = $requete->fetch(PDO::FETCH_ASSOC);
			return $resultat['last'];
		}
		
		// -- Insertions --
		static function insertReservation($id)
		{
			global $bdd;
			
			// -- Insertion --
			
			$idResa = compteur('idReservation');
			$requete = $bdd->prepare('INSERT INTO reservations (id_reservation, id_admin, id_etat, debut_reservation, fin_reservation, terminer_reservation) VALUES (:idResa, :id, 1, NOW(), DATE_ADD(NOW(), INTERVAL 15 DAY), false) ;');
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->bindParam(':idResa', $idResa, PDO::PARAM_STR);
			$requete->execute();
			return $idResa;
		}
		
		static function createLink($exemplaire, $reservation)
		{
			global $bdd;
			
			// -- Insertion --
			$requete = $bdd->prepare('INSERT INTO concerner (num_exemplaire, id_reservation) VALUES (:exemplaire, :reservation) ;');
			$requete->bindParam(':exemplaire', $exemplaire, PDO::PARAM_INT);
			$requete->bindParam(':reservation', $reservation, PDO::PARAM_STR);
			$requete->execute();
		}
		
		static function setEmprunts($list)
		{
			global $visiteur;
			global $bdd;
			
			$retour = array('valeur'=>true, 'message'=>'Enegistrements effectués.'); 
			$i = 0;
			$listeSec = array();
			
			foreach($list as $element)
			{
				$emprunt = ModelMedia::getAll($element);
				if(empty($emprunt))
				{
					$retour['message'] = "Ce média n'existe pas !";
				}
				else
				{					
					if($i < 3)
					{
						array_push($listeSec, $element);
						$i++;
					}
					else
					{
						$retour['message'] = "Trop d'emprunts!";
					}
				}
			}
			$bdd->beginTransaction();
			$lastReservationId = ModelMedia::insertReservation($visiteur['id']);
			
			foreach($list as $element)
			{
				$last = ModelMedia::getLastFreeMediaId($element);
				if(empty($last))
				{
					$retour['message'] = "Aucun exemplaire de libre pour ce média!";
				}
				else
				{
					ModelMedia::createLink($last, $lastReservationId);
				}
			}
			$bdd->commit();
			return $retour;
		}
		
		static function getEmprunts($id)
		{
			global $bdd;
			
			// -- Récupération --
			$requete = $bdd->prepare('SELECT m.id_media AS id, m.titre_media AS titre FROM Reservations r'. 
				' INNER JOIN Concerner c ON c.id_reservation = r.id_reservation'.
				' INNER JOIN Exemplaires e ON e.num_exemplaire = c.num_exemplaire'.
				' INNER JOIN Medias m ON e.id_media = m.id_media'.
				' WHERE r.id_admin = :id');
			$requete->bindParam(':id', $id, PDO::PARAM_INT);
			$requete->execute();
			
			$retour = array();
			$i = 0;
			while($element = $requete->fetch(PDO::FETCH_ASSOC))
			{
				$emprunt = array();
				
				$emprunt['id'] = intval($element['id']);
				$emprunt['titre'] = Securite::html($element['titre']);
				
				$retour[$id] = $emprunt;
				$i++;
			}
			
			return $retour;
		}
	}
	
?>