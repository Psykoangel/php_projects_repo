<div class="container">
    <h3>Votre Panier : </h3>
    <form action="?user=panier" method="POST" >
      <div class="row">
    <?php
        if (!empty($page['panier'])) 
        {
            foreach($page['panier'] as $element)
            {
                if (!empty($element))
                {
                    
    ?>
        <div class="span4">
          <h2><?php echo $element->title(); ?></h2>
          <?php echo '<li><input name="finalList[]" type="checkbox" value="'.$element->identifier().'" ></li>'; ?>
          <p><?php echo $element->affichage(); ?></p>
        </div>
    <?php
                }
            }
        }
        else
        {
    ?>
        <div class="span4">
          <p>Aucun média ne se trouve actuellement dans votre panier !</p>
        </div>
    <?php
        }
    ?>           
      </div>
    <?php
        if (!empty($page['panier'])) 
        {
    ?>
      <button type="submit" class="btn btn-large" name="supp" >Supprimer la sélection</button>
      <button type="submit" class="btn btn-large btn-block btn-primary" name="valid" >Valider votre panier</button>
    <?php
        }
    ?>
    </form>
</div>