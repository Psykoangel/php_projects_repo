<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style.css" />
        <title>Workshop PHP</title>
    </head>
    <body>
        
        <fieldset>
            <legend>authentification</legend>
            
            <form id="connexion" method="POST" action="catalogueArticle.php">
                <label for="pseudoCO">login : </label><input type="text" name="pseudoCO" id="pseudoCO" />
                <label for="modepassCO">mdp : </label><input type="password" name="modepassCO" id="modepassCO" />
                <input type="submit" value="Valider" name="valid"/>
            </form>
        </fieldset>
        
        <fieldset>
            <legend>inscription</legend>
            
            <form id="inscription" method="POST" action="catalogueArticle.php">
                <label for="pseudoIN">login : </label><input type="text" name="pseudoIN" id="pseudoIN" />
                <label for="modepassIN">mdp : </label><input type="password" name="modepassIN" id="modepassIN" />
                <input type="submit" value="Inscription" name="insc"/>
            </form>
        </fieldset>
        
    </body>
</html>
