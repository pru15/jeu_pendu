<?php
require_once('header.php');
require_once('footer.php');

if(!empty($_SESSION['j1']) && !empty($_SESSION['j2'])){
    ?>
    <form method = "GET" action="index.php">
    <label>Joueur 1 :</label>
    <input name="j1" value="<?php echo (!empty($_GET['j1']) ? substr($_GET['j1'], 0, 100) : '');?>" type="text"/>
    <label>Joueur 2 :</label>
    <input name="j2" value="<?php echo (!empty($_GET['j2']) ? substr($_GET['j2'], 0, 100) : '');?>" type="text"/>
    
    <button type="submit">Envoyer</button>
    
    </form>

    
    <h2><a href="def_jeu.php">Nouvelle partie</a></h2>

    <?php
}
else{
    ?>
    <form method = "GET" action="index.php">
    <label>Joueur 1 :</label>
    <input name="j1" value="<?php echo (!empty($_GET['j1']) ? substr($_GET['j1'], 0, 100) : '');?>" type="text"/>
    <label>Joueur 2 :</label>
    <input name="j2" value="<?php echo (!empty($_GET['j2']) ? substr($_GET['j2'], 0, 100) : '');?>" type="text"/>
    
    <button type="submit">Envoyer</button>
    
    </form>


    <?php

}?>




<section id="Vos parties">
    <h2>Vos parties</h2>
    <?php
    $sql="SELECT * FROM partie WHERE j1 = ? OR j2 = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_SESSION['j1'],$_SESSION['j1']]);
    $stmt2 = $db->prepare($sql);
    $stmt2->execute([$_SESSION['j2'], $_SESSION['j2']]); 

    echo("<h3>Parties de " . $_SESSION['j1'] . "</h3>");
    foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $partie){
        echo("<p>Joueur 1 : " . $partie['j1'] . " | Joueur 2 : " . $partie['j2'] . " | Victoire : " . ($partie['victoire'] ? 'Oui' : 'Non') . " | Nombre d'erreurs : " . $partie['nb_erreurs'] . "</p>");
    }
    echo("<h3>Parties de " . $_SESSION['j2'] . "</h3>");
    foreach($stmt2->fetchAll(PDO::FETCH_ASSOC) as $partie){
        echo("<p>Joueur 1 : " . $partie['j1'] . " | Joueur 2 : " . $partie['j2'] . " | Victoire : " . ($partie['victoire'] ? 'Oui' : 'Non') . " | Nombre d'erreurs : " . $partie['nb_erreurs'] . "</p>");
    }?> 
</section>


<?php
    if(!empty($_GET) && !empty($_GET['j1']) && !empty($_GET['j2'])){
        
        $_SESSION['j1']=htmlspecialchars($_GET['j1']);
        $_SESSION['j2']=htmlspecialchars($_GET['j2']);
    }
?>