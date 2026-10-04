<?php
require_once('header.php');
require_once('footer.php');

$_SESSION['alphabet'] = [
    'a' => false,
    'b' => false,
    'c' => false,
    'd' => false,
    'e' => false,
    'f' => false,
    'g' => false,
    'h' => false,
    'i' => false,
    'j' => false,
    'k' => false,
    'l' => false,
    'm' => false,
    'n' => false,
    'o' => false,
    'p' => false,
    'q' => false,
    'r' => false,
    's' => false,
    't' => false,
    'u' => false,
    'v' => false,
    'w' => false,
    'x' => false,
    'y' => false,
    'z' => false
];
?>

<form method=POST action="def_jeu.php">
    <label>Nombre de coups maximum</label>
    <input name="nb_coups" value=10 type="number" min="1" max="11"/>
    <?php
    echo"<label>Choix du mot par " . $_SESSION['j1'] . " : </label>";
    ?>
    <input name="mot_a_deviner" value="" type="text"/>
    <button type="submit">Envoyer</button>
</form>
<?php
    if(!empty($_POST) && !empty($_POST['mot_a_deviner'])){
        $_SESSION['mot_a_deviner']=htmlspecialchars($_POST['mot_a_deviner']);
        $_SESSION['nb_coups_init']=htmlspecialchars($_POST['nb_coups']);
        $_SESSION['nb_coups']=htmlspecialchars($_POST['nb_coups']);
        $_SESSION['mot_connu']="_";
        for($i=0; $i<strlen($_SESSION['mot_a_deviner'])-1; $i++){
            $_SESSION['mot_connu']= $_SESSION['mot_connu'] . "_";
        }
        header('Location: jeu.php?traitement=OK');
        exit(0);
    }
?>