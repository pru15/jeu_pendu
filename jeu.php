<?php
require_once('header.php');
require_once('footer.php');

$dessin_pendu = [
    0 => " \n \n\n\n\n\n\n",
    1 => " \n \n\n\n\n\n_____\n",
    2 => "  \n |      \n | \n |      \n |       \n |      \n_|___\n",
    3 => "  \n |/      \n |      \n |      \n |       \n |      \n_|___\n",
    4 => "  _______\n |/      \n |      \n |      \n |       \n |      \n_|___\n",
    5 => "  _______\n |/      |\n |      \n |      \n |       \n |      \n_|___\n",
    6 => "  _______\n |/      |\n |      (_)\n |      \n |       \n |      \n_|___\n",
    7 => "  _______\n |/      |\n |      (_)\n |       |\n |       \n |      \n_|___\n",
    8 => "  _______\n |/      |\n |      (_)\n |       |\n |       |\n |      \n_|___\n",
    9 => "  _______\n |/      |\n |      (_)\n |      \\|\n |       |\n |      \n_|___\n",
    10 => "  _______\n |/      |\n |      (_)\n |      \\|/\n |       |\n |      \n_|___\n",
    11 => "  _______\n |/      |\n |      (_)\n |      \\|/\n |       |\n |      / \\\n_|___\n"
];




function nouvelle_lettre($mot, $mot_connu, $nouv_lettre){
    $_SESSION['alphabet'][$nouv_lettre] = true;
    $bonne_lettre = false;
    if(strlen($nouv_lettre)=== 1){
        for($i=0; $i<strlen($mot); $i++){
            if($mot[$i] === $nouv_lettre && $mot_connu[$i] === "_"){
                $mot_connu[$i] = $nouv_lettre;
                $bonne_lettre = true;
            }
        }
    }
    elseif($mot === $nouv_lettre){
        $mot_connu = $mot;
        $bonne_lettre = true;
    }
    if(!($bonne_lettre)){
        $_SESSION['nb_coups']-=1;;
    }
    return $mot_connu;
}



if(!empty($_POST) && !empty($_POST['lettre'])){
    $_SESSION['mot_connu']= nouvelle_lettre($_SESSION['mot_a_deviner'], $_SESSION['mot_connu'], htmlspecialchars($_POST['lettre']));
}

echo("<pre>" . $dessin_pendu[11 - $_SESSION['nb_coups']] . "</pre>");

echo("<h2>" . $_SESSION['nb_coups'] . " coups restants</h2>");
echo("<h2>" . implode(" ", mb_str_split($_SESSION['mot_connu'])). "</h2>");

if($_SESSION['mot_a_deviner'] === $_SESSION['mot_connu']){
    echo("Bravo !!!!!!");
    $sql = "INSERT INTO partie (j1, j2, victoire, nb_erreurs) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_SESSION['j1'], $_SESSION['j2'], true, $_SESSION['nb_coups_init'] - $_SESSION['nb_coups']]);
}
else if($_SESSION['nb_coups'] === 0){
    echo("Dommage !!!!!!");
    $sql = "INSERT INTO partie (j1, j2, victoire, nb_erreurs) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$_SESSION['j1'], $_SESSION['j2'], false, $_SESSION['nb_coups_init'] - $_SESSION['nb_coups']]);
}
else{
    ?>
    <form method=POST action="jeu.php">
    <label>Lettre ou mot : </label>
    <input name="lettre" type="text" autofocus/>
    <button type="submit">Jouer</button>
    </form>
<?php
}
?>

<section id="alphabet">
    <h2>Lettres</h2>
    <?php
    foreach($_SESSION['alphabet'] as $lettre => $connue){
        if($connue === true){
            echo("<span class='connue'>" . $lettre . " </span>");
        }   
        else{
            echo("<span class='inconnue'> " . $lettre . " </span>");
        }
    }

?>
</section>


