<?PHP


/*const PIERRE = 'pierre';
const FEUILLE = 'feuille';
const CISEAUX = 'ciseaux';*/
$possibilites = [1, 2, 3];

if (! isset($_SESSION['nb_jeux'])) {
    $_SESSION['nb_jeux'] = 0;
}
switch($_SESSION['nb_jeux']) {
    case 0:
        // tour 1, on donne un résultat aléatoire
        $alea = rand(0,2);
        $choix = $possibilites[$alea];
        $_SESSION['jeux_hal_t_1'] = $choix;
        $_SESSION['HAL'] = $choix;
        $_SESSION['jeux_humain_t_1'] = $_GET['rep'];
        break;
                

    case 1:
        // tour 2, en fonction du choix réalisé par l'utilisateur lors du tour 1, HAL choisit l'option permettant de battre cette option
        switch($_SESSION['jeux_humain_t_1']){
            case 1:
                $_SESSION['jeux_hal_t_2'] = 1;
                $_SESSION['HAL'] = 1;
                break;

            
            case 2:
                $_SESSION['jeux_hal_t_2'] = 2;
                $_SESSION['HAL'] = 2;
                break;
            

            case 3:
                $_SESSION['jeux_hal_t_2'] = 3;
                $_SESSION['HAL'] = 3;
                break;
    
        }
        break;

    case 2:
        // tour 3, HAL répète ce qu'il a dit en tour 1
        $_SESSION['HAL'] = $_SESSION['jeux_hal_t_1'];
        break;

    case 3:
        // tour 4, HAL donne une option qu'il n'a encore jamais dite ou qu'il n'a pas dite depuis longtemps
        $_SESSION['boucle_tour_4'] = false;

        while($_SESSION['boucle_tour_4'] == false){
            $TENTATIVE = 0;

            if($_SESSION['jeux_hal_t_1'] == $possibilites[$TENTATIVE] or $_SESSION['jeux_hal_t_2'] == $possibilites[$TENTATIVE]) {
                $_SESSION['boucle_tour_4'] = true;
                $_SESSION['HAL'] = $possibilites[$TENTATIVE];
                $_SESSION['jeux_humain_t_4'] = $possibilites[$TENTATIVE];
            }
            else{
                $TENTATIVE = $TENTATIVE + 1;
            }
            
        }
        break;

    case 4:
        // tour 5, HAL répète ce que le joueur a donné en tour 4
        $_SESSION['HAL'] = $_SESSION['jeux_humain_t_4'];
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