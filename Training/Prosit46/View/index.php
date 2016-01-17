<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="../CSS/style.css" />
        <title>test php</title>
    </head>
    <body>
        <header>
            <div id="hello">
                <h1>Welcome on the PHP Forum !</h1>
            </div>
            <?php
                if(isset($_SESSION['USER_PSEUDO']))
                {
                    echo 'Hello ' . $_SESSION['USER_PSEUDO'] . ' !!';
                    echo '<a href="Deconnexion.php">Deconnexion</a>';
                }
                else
                {
                    include('../Template/auth.php');
                }
            ?>
        </header>
        
        <nav>
            <ul>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </nav>
        
        <section>
            <article>
                
            </article>
            
            <aside>
                
            </aside>
        </section>
        
        <footer>
            
        </footer>
    </body>
</html>