<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />

        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Administration</title>
        <meta name="description" content="" />

        <meta name="viewport" content="width=device-width; initial-scale=1.0" />

        <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
        <link rel="shortcut icon" href="<?php echo $data['path']; ?>img/favicon.ico" />
        <link rel="apple-touch-icon" href="<?php echo $data['path']; ?>img/apple-touch-icon.png" />

        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo $data['path']; ?>css/main.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
        <?php echo $data['liensCSS']; ?>

        <!-- JS -->
        <?php echo $data['liensJS']; ?>
    </head>

    <body>
        <header>

        </header>
        <nav>

        </nav>

        <div class="main_container">
            <div class="left_container">
                <section>
                    <img src="<?php echo $data['path']; ?>img/logo.png" alt="LogoExiaCesi" />
                    <h4>Bonjour, </h4><span id="USER"><?php echo $visiteur['nom']; ?></span>
                    <ul>
                        <li style="width: 32px;"><a href="?deco"><img src='<?php echo $data['path']; ?>img/log_out.png' title="Déconnexion"/></a></li>
                        <li style="width: 32px;"><a href="?user"><img src='<?php echo $data['path']; ?>img/switchuser.png' title="Passer en Mode utilisateur"/></a></li>
                    </ul>							
                    <nav>
                        <div id="one" class="section">
                            <h3>
                                <a href="#one">Sections</a>
                            </h3>
                            <div>
                                <a href="?admin">Accueil</a><br/>
                                <a href="?admin=media">Médias</a>
                            </div>
                        </div>
                        <div id="two" class="section">
                            <h3>
                                <a href="#two">Médias</a>
                            </h3>
                            <div>
                                <a href="?admin=media&action=ajouter">Ajouter un média</a> <br />
                                <a href="?admin=media&action=modifier">Modifier un média</a> <br />
                                <a href="?admin=media&action=supprimer">Supprimer un média</a> <br />
                            </div>
                        </div>
                        <div id="Exemplaires" class="section">
                            <h3>
                                <a href="#Exemplaires">Exemplaires</a>
                            </h3>
                            <div>
                                <a href="?admin=exemplaire&action=ajouter">Ajouter un exemplaire</a> <br />
                                <a href="?admin=exemplaire&action=modifier">Modifier un exemplaire</a> <br />
                                <a href="?admin=exemplaire&action=supprimer">Supprimer un exemplaire</a> <br />
                            </div>
                        </div>
                        <div id="Reservation" class="section">
                            <h3>
                                <a href="#Reservation">Reservation</a>
                            </h3>
                            <div>
                                <a href="?admin=reservation&action=valider">Valider une réservation</a> <br />
                                <a href="?admin=reservation&action=cloturer">Cloturer une réservation</a> <br />
                                <!--<a href="?admin=media&action=supprimer">Supprimer un média</a> <br />-->
                            </div>
                        </div>
                        <div id="three" class="section">
                            <h3>
                                <a href="#three">Extensions</a>
                            </h3>
                            <div>
                                <a href="?admin=extends&ext=keywords">Mot-clés</a> <br />
                                <a href="?admin=extends&ext=auteurs">Auteurs</a> <br />
                                <a href="?admin=extends&ext=editeurs">Editeurs</a> <br />
                                <a href="?admin=extends&ext=types">Types de média</a> <br />
                                <a href="?admin=extends&ext=etats">Etats de réservation</a> <br />
                            </div>
                        </div>
                        <div id="four" class="section">
                            <h3>
                                <a href="#four">Membres</a>
                            </h3>
                            <div>
                                <a href="?admin=extends&ext=roles">Roles de membres</a> <br />
                                <a href="?admin=inscription">Inscription</a>
                            </div>
                    </nav>
                </section>
            </div>
            <div class="right_container">
                <header>
                    <img src="<?php echo $data['path']; ?>img/icone_admin.png" alt="LogoADM" />
                    <h1> Gestion du CDI : Administration </h1> 
                </header>
                <section>
                    <header>

                    </header>
                    <?php echo $data['navi']; ?>
                    <?php include $data['page']; ?>
                </section>						
            </div>					
        </div>

        <footer>

        </footer>
    </body>
</html>
