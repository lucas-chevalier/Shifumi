<?PHP

session_start();
const PIERRE = 'pierre';
const FEUILLE = 'feuille';
const CISEAUX = 'ciseaux';
$possibilites = [PIERRE, FEUILLE, CISEAUX];

if (! isset($_SESSION['nb_jeux'])) {
    $_SESSION['nb_jeux'] = 0;
}
switch($_SESSION['nb_jeux']) {
    case 0:
        // tour 1, on donne un résultat aléatoire
        $alea = rand(0,2);
        $choix = $possibilites[$alea];
        $_SESSION['jeux_hal'][1] = $choix;
        echo $choix;
                

    case 1:
        // tour 2, en fonction du choix réalisé par l'utilisateur lors du tour 1, HAL choisit l'option permettant de battre cette option
        switch($_SESSION['jeux_humain'][1]){
            case PIERRE:
                $_SESSION['jeux_hal'][2] = FEUILLE;
                echo FEUILLE;
                break;

            case CISEAUX:
                $_SESSION['jeux_hal'][2] = PIERRE;
                echo PIERRE;
                break;

            case FEUILLE:
                $_SESSION['jeux_hal'][2] = CISEAUX;
                echo CISEAUX;
                break;
        }
        break;

    case 2:
        // tour 3, HAL répète ce qu'il a dit en tour 1
        echo $_SESSION['jeux_hal'][1];
        break;

    case 3:
        // tour 4, HAL donne une option qu'il n'a encore jamais dite ou qu'il n'a pas dite depuis longtemps
        $_SESSION['boucle_tour_4'] = false;

        while($_SESSION['boucle_tour_4'] == false){
            $TENTATIVE = rand(0,2);
            
            if(! $_SESSION['jeux_hal'][1] == $possibilites[$TENTATIVE] and ! $_SESSION['jeu_hal'][2] == $possibilites[$TENTATIVE])
            $_SESSION['boucle_tour_4'] = true;
            echo $possibilites[$TENTATIVE];
        }
        break;

    case 4:
        // tour 5, HAL répète ce que le joueur a donné en tour 4
        echo $_SESSION['jeux_humain'][4];
        break;

}

// qualcule de ou est hal dans ces tours
if ($_SESSION['nb_jeux'] == 4){
    $_SESSION['nb_jeux'] = 0;
}
else{
    $_SESSION['nb_jeux']++;
}

?>