<!-- CSS du carrousel -->
<style type="text/css">
#c2carrousel{text-align:center;}
#c2carrousel img{max-width:250px;max-height:250px;}
</style>
<?php

function quizzDivMaker($id_quizz) {
    require('DBconnexion.php');
    $query = "SELECT * FROM `quizz` WHERE id_quizz='$id_quizz'";
    $result = mysqli_query($conn, $query);
    $quizz = mysqli_fetch_assoc($result);
    $title_quizz = $quizz['titre_quizz'];
    $theme_quizz = $quizz['theme_quizz'];

    return "<div class='quizz'>
        <div class='titlequizzmainpage'>
            $title_quizz
        </div>
        <div class='themequizzmainpage'>
            $theme_quizz
        </div>
        <div class='quizzButton quizzPlay'>
            <form action='quizz.php' method='POST'>
                <input type='hidden' name='id_quizz' value='$id_quizz'>
                <button type='submit' name='choose2-quizz-btn' class='quizzButton choose2-quizz-btn'>Jouer !</button>
            </form>
        </div>";
}
/*
* page: carrousel.php
*/
session_start();
require('DBconnexion.php');
$user = $_SESSION['user'];
$id_utilisateur = $user['id_utilisateur'];
$query = "SELECT * FROM `quizz` WHERE auteur_quizz='$id_utilisateur'";
$result = mysqli_query($conn, $query);
$carrouselMyQuizzArray = [0];
while($row = mysqli_fetch_assoc($result)){
    array_push($carrouselMyQuizzArray,$row['id_quizz']);
}
var_dump($carrouselMyQuizzArray);


echo '<div id="carrouselMyQuizz">';
if(count($carrouselMyQuizzArray)==1){
    echo "Tu n'as pas encore créé de quizz !";
} else {
    $previousLink='';
    $quizzShown=$carrouselMyQuizzArray[1];
    if(count($carrouselMyQuizzArray) == 2) {
        $previousLink=isset($carrouselMyQuizzArray[1])?'<a href="carrousel.php?quizz='.(1).'">Quizz précédent</a>':'';
        $quizzShown=quizzDivMaker($carrouselMyQuizzArray[1]);
    }elseif( count($carrouselMyQuizzArray) == 3 ) {
        $previousLink=isset($carrouselMyQuizzArray[2])?'<a href="carrousel.php?quizz='.(2).'">Quizz précédent</a>':'';
        $previousQuizz=quizzDivMaker($carrouselMyQuizzArray[count($carrouselMyQuizzArray)-1]);
        $quizzShown=quizzDivMaker($carrouselMyQuizzArray[1]);
        $nextQuizz=quizzDivMaker($carrouselMyQuizzArray[2]);
        $nextLink=isset($carrouselMyQuizzArray[2])?'<a href="carrousel.php?quizz='.(2).'">Quizz suivant</a>':'';
    }elseif(count($carrouselMyQuizzArray) >= 4) {
        $previousLink=isset($carrouselMyQuizzArray[count($carrouselMyQuizzArray)-1])?'<a href="carrousel.php?quizz='.(count($carrouselMyQuizzArray)-1).'">Quizz précédent</a>':'';
        $previousQuizz=quizzDivMaker($carrouselMyQuizzArray[1]);
        $quizzShown=quizzDivMaker($carrouselMyQuizzArray[2]);
        $nextQuizz=quizzDivMaker($carrouselMyQuizzArray[3]);
        $nextLink=isset($carrouselMyQuizzArray[3])?'<a href="carrousel.php?quizz='.(3).'">Quizz suivant</a>':'';
    }

    if(isset($_GET['quizz']) and is_int((int)$_GET['quizz'])){
        if(array_key_exists($_GET['quizz'],$carrouselMyQuizzArray)){
            if($_GET['quizz'] == 1){
                $previousLink=isset($carrouselMyQuizzArray[count($carrouselMyQuizzArray)-1])?'<a href="carrousel.php?quizz='.(count($carrouselMyQuizzArray)-1).'">Quizz précédent</a>':'';
                $previousQuizz=quizzDivMaker($carrouselMyQuizzArray[count($carrouselMyQuizzArray)-1]);
                $quizzShown=quizzDivMaker($carrouselMyQuizzArray[$_GET['quizz']]);
                $nextQuizz=quizzDivMaker($carrouselMyQuizzArray[$_GET['quizz']+1]);
                $nextLink=isset($carrouselMyQuizzArray[$_GET['quizz']+1])?'<a href="carrousel.php?quizz='.($_GET['quizz']+1).'">Quizz suivant</a>':'';
                
            }elseif($_GET['quizz'] == count($carrouselMyQuizzArray)-1){
                $previousLink=isset($carrouselMyQuizzArray[$_GET['quizz']-1])?'<a href="carrousel.php?quizz='.($_GET['quizz']-1).'">Quizz précédent</a>':'';
                $previousQuizz=quizzDivMaker($carrouselMyQuizzArray[$_GET['quizz']-1]);
                $quizzShown=quizzDivMaker($carrouselMyQuizzArray[$_GET['quizz']]);
                $nextQuizz=quizzDivMaker($carrouselMyQuizzArray[1]);
                $nextLink=isset($carrouselMyQuizzArray[1])?'<a href="carrousel.php?quizz='.(1).'">Quizz suivant</a>':'';
            }else{
                $previousLink=isset($carrouselMyQuizzArray[$_GET['quizz']-1])?'<a href="carrousel.php?quizz='.($_GET['quizz']-1).'">Quizz précédent</a>':'';
                $previousQuizz=quizzDivMaker($carrouselMyQuizzArray[$_GET['quizz']-1]);
                $quizzShown=quizzDivMaker($carrouselMyQuizzArray[$_GET['quizz']]);
                $nextQuizz=quizzDivMaker($carrouselMyQuizzArray[$_GET['quizz']+1]);
                $nextLink=isset($carrouselMyQuizzArray[$_GET['quizz']+1])?'<a href="carrousel.php?quizz='.($_GET['quizz']+1).'">Quizz suivant</a>':'';
            }
        }
    }
    echo '<table style="width:100%">';
        echo '<tr><td></td><th></td><th>'.(count($carrouselMyQuizzArray)-1).' quizz'.(count($carrouselMyQuizzArray)>1?'s':'').'</td><th></th><td></td></tr>';
        echo '<tr><td></td><td></td></tr>';
        echo '<tr>
        <td style="text-align:center">'.$previousLink.'</td>
        <td style="text-align:center">'.$quizzShown.'</td>
        <td style="text-align:center">'.$previousQuizz.'</td>
        <td style="text-align:center">'.$nextQuizz.'</td>
        <td style="text-align:center">'.$nextLink.'</td>
        </tr>';
    echo '</table>';
}
echo '</div>';
?>
