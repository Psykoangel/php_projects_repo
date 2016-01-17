<?php
	
	/* -- Classe -- */
	class Media
	{
            private $infos;

            function __construct($array)
            {
                // Protections --

                $this->infos = $array;
            }
            
            function getInfos()
            {
                return $this->infos['id_media'];
            }

            function identifier()
            {
                return $this->infos['id_media'];
            }

            function title()
            {
                return $this->infos['titre_media'];
            }

            function affichage()
            { 
            ?>
                <li style="list-style-type: none;">
                    <div>
                        <p>ID: <?php echo $this->infos['id_media']; ?> </p>
                        <p>Cat.: <?php echo utf8_encode($this->infos['nom_categorie']); ?> </p>
                        <p>Type: <?php echo utf8_encode($this->infos['nom_type']); ?> </p>
                        <p>Admin: <?php echo utf8_encode($this->infos['nom_admin']); ?> </p>
                        <p>ISBN: <?php echo $this->infos['isbn_media']; ?> </p>
                        <p>Résume: <?php echo utf8_encode($this->infos['resume_media']); ?> </p>
                    </div>
                </li>		
            <?php
            }
	}