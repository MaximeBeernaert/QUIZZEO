<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu utilisateur</title>
</head>

<body>
    <header>
        <?php
        require('header.php');
        ?>
    </header>
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
            <div class='quizzPlay'>
                <form action='quizz.php' method='POST'>
                    <input type='hidden' name='id_quizz' value='$id_quizz'>
                    <button type='submit' name='choose2-quizz-btn' class='quizzButton choose2-quizz-btn'>Jouer !</button>
                </form>
                <form action='modif.php' method='POST'>
                    <input type='hidden' name='id_quizz' value='$id_quizz'>
                    <button type='submit' name='modify2-quizz-btn' class='quizzButton modify2-quizz-btn'>Modifier !</button>
                </form>
                <form action='usermenu.php' method='POST'>
                    <input type='hidden' name='id_quizz' value='$id_quizz'>
                    <button type='submit' name='delete2-quizz-btn' class='quizzButton delete2-quizz-btn'>Supprimer !</button>
                </form>
            </div>
            </div>";
    }
    function checkSuppression() {
        if(isset($_POST['id_quizz'])){
            $id_quizz = $_POST['id_quizz'];
            echo "
                        <br>
                        <p>Êtes-vous sûr de vouloir supprimer ce quizz ?</p>
                        <form action='usermenu.php' method='POST'>
                            <input type='hidden' name='id_quizz' value='$id_quizz'>
                            <button type='submit' name='confirm-delete-btn' class='confirm-delete-btn buttonRed'>Oui</button>
                        </form>
                        <form action='usermenu.php' method='POST'>
                            <button type='submit' name='buttonBlack cancel-delete-btn' class='buttonBlack cancel-delete-btn'>Non</button>
                        </form>
                        <br>";
            
        }
    }
    function suppression($conn) {
        if (isset($_POST['confirm-delete-btn'])) {

            $id_quizz = $_POST['id_quizz'];
    
            $query = "DELETE FROM `choix` WHERE id_choix IN (SELECT id_choix FROM `appartenir` WHERE id_question IN (SELECT id_question FROM `questions` WHERE id_question IN (SELECT id_question FROM `contient` WHERE id_quizz='$id_quizz')))";
            $result = mysqli_query($conn, $query);
    
            $query = "DELETE FROM `appartenir` WHERE id_question IN (SELECT id_question FROM `questions` WHERE id_question IN (SELECT id_question FROM `contient` WHERE id_quizz='$id_quizz'))";
            $result = mysqli_query($conn, $query);
    
            $query = "DELETE FROM `questions` WHERE id_question IN (SELECT id_question FROM `contient` WHERE id_quizz='$id_quizz')";
            $result = mysqli_query($conn, $query);
    
            $query = "DELETE FROM `contient` WHERE id_quizz='$id_quizz'";
            $result = mysqli_query($conn, $query);
    
            $query = "DELETE FROM 'jouer' WHERE id_quizz='$id_quizz'";
            $result = mysqli_query($conn, $query);
    
            $query = "DELETE FROM `quizz` WHERE id_quizz='$id_quizz'";
            $result = mysqli_query($conn, $query);
    
            echo ("<meta http-equiv='refresh' content='1'>");
        }
    }


    if (isset($_COOKIE['currentHouse'])) {
        $currentHouse = str_replace("houseButton ", "", $_COOKIE['currentHouse']);
    } else {
        $currentHouse = 'Serpentard';
    }
    ?>
    <div class="mainPage">
        <div class="banner">
            <?php echo "<img class='houseIcone $currentHouse' src='GriffondorIcone.png'>" ?>
        </div>
        <?php
        $user = $_SESSION['user'];
        $id_utilisateur = $user['id_utilisateur'];
        $type_utilisateur = $user['type_utilisateur'];
        ?>
        <div class="userQuizzList">
        <?php
        
        //if the user is a  utilisateur (type_utilisateur = 0), he can only see all the quizzes
        if ($type_utilisateur == 1 || $type_utilisateur == 2) :
        ?>
            
            <div class="usermenuQuizzList">Mes quizz :</div>
        <?php
            

            
            $query = "SELECT * FROM `quizz` WHERE auteur_quizz='$id_utilisateur'";
            $result = mysqli_query($conn, $query);
            $carrouselMyQuizzArray = [0];
            while($row = mysqli_fetch_assoc($result)){
                array_push($carrouselMyQuizzArray,$row['id_quizz']);
            }
            
            echo '<div class="carrouselMyQuizz">';
            if(count($carrouselMyQuizzArray)==1){
                echo "Tu n'as pas encore créé de quizz !";
            } else {
                $previousLink='';
                $quizzShown=$carrouselMyQuizzArray[1];
                if(count($carrouselMyQuizzArray) == 2) {
                    $previousLink='';
                    $previousQuizz='';
                    $quizzShown=quizzDivMaker($carrouselMyQuizzArray[1]);
                    $nextQuizz='';
                    $nextLink='';
                }elseif( count($carrouselMyQuizzArray) == 3 ) {
                    $previousLink=isset($carrouselMyQuizzArray[2])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?myquizz='.(2).'">Quizz précédent</a></div>':'';
                    $previousQuizz=quizzDivMaker($carrouselMyQuizzArray[count($carrouselMyQuizzArray)-1]);
                    $quizzShown=quizzDivMaker($carrouselMyQuizzArray[1]);
                    $nextQuizz=quizzDivMaker($carrouselMyQuizzArray[2]);
                    $nextLink=isset($carrouselMyQuizzArray[2])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?myquizz='.(2).'">Quizz suivant</a></div>':'';
                }elseif(count($carrouselMyQuizzArray) >= 4) {
                    $previousLink=isset($carrouselMyQuizzArray[count($carrouselMyQuizzArray)-1])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?myquizz='.(count($carrouselMyQuizzArray)-1).'">Quizz précédent</a></div>':'';
                    $previousQuizz=quizzDivMaker($carrouselMyQuizzArray[1]);
                    $quizzShown=quizzDivMaker($carrouselMyQuizzArray[2]);
                    $nextQuizz=quizzDivMaker($carrouselMyQuizzArray[3]);
                    $nextLink=isset($carrouselMyQuizzArray[3])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?myquizz='.(3).'">Quizz suivant</a></div>':'';
                }
            
                if(isset($_GET['myquizz']) and is_int((int)$_GET['myquizz'])){
                    if(array_key_exists($_GET['myquizz'],$carrouselMyQuizzArray)){
                        if($_GET['myquizz'] == 1){
                            $previousLink=isset($carrouselMyQuizzArray[count($carrouselMyQuizzArray)-1])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?myquizz='.(count($carrouselMyQuizzArray)-1).'">Quizz précédent</a></div>':'';
                            $previousQuizz=quizzDivMaker($carrouselMyQuizzArray[count($carrouselMyQuizzArray)-1]);
                            $quizzShown=quizzDivMaker($carrouselMyQuizzArray[$_GET['myquizz']]);
                            $nextQuizz=quizzDivMaker($carrouselMyQuizzArray[$_GET['myquizz']+1]);
                            $nextLink=isset($carrouselMyQuizzArray[$_GET['myquizz']+1])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?myquizz='.($_GET['myquizz']+1).'">Quizz suivant</a></div>':'';
                            
                        }elseif($_GET['myquizz'] == count($carrouselMyQuizzArray)-1){
                            $previousLink=isset($carrouselMyQuizzArray[$_GET['myquizz']-1])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?myquizz='.($_GET['myquizz']-1).'">Quizz précédent</a></div>':'';
                            $previousQuizz=quizzDivMaker($carrouselMyQuizzArray[$_GET['myquizz']-1]);
                            $quizzShown=quizzDivMaker($carrouselMyQuizzArray[$_GET['myquizz']]);
                            $nextQuizz=quizzDivMaker($carrouselMyQuizzArray[1]);
                            $nextLink=isset($carrouselMyQuizzArray[1])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?myquizz='.(1).'">Quizz suivant</a></div>':'';
                        }else{
                            $previousLink=isset($carrouselMyQuizzArray[$_GET['myquizz']-1])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?myquizz='.($_GET['myquizz']-1).'">Quizz précédent</a></div>':'';
                            $previousQuizz=quizzDivMaker($carrouselMyQuizzArray[$_GET['myquizz']-1]);
                            $quizzShown=quizzDivMaker($carrouselMyQuizzArray[$_GET['myquizz']]);
                            $nextQuizz=quizzDivMaker($carrouselMyQuizzArray[$_GET['myquizz']+1]);
                            $nextLink=isset($carrouselMyQuizzArray[$_GET['myquizz']+1])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?myquizz='.($_GET['myquizz']+1).'">Quizz suivant</a></div>':'';
                        }
                    }
                }
                echo $previousLink;
                echo $previousQuizz;
                echo $quizzShown;
                echo $nextQuizz;
                echo $nextLink;
            }
            echo '</div>';
        endif;
        checkSuppression();
        suppression($conn);
        ?>
        
                <div class="usermenuQuizzList">Tous les quizz :</div>
                <?php
            
            $query = "SELECT * FROM `quizz`";
            $result = mysqli_query($conn, $query);
            $carrouselMyQuizzArray = [0];
            while($row = mysqli_fetch_assoc($result)){
                array_push($carrouselMyQuizzArray,$row['id_quizz']);
            }
            
            echo '<div class="carrouselMyQuizz">';
            if(count($carrouselMyQuizzArray)==1){
                echo "Il n'y a pas encore de quizz !";
            } else {
                $previousLink='';
                $quizzShown=$carrouselMyQuizzArray[1];
                if(count($carrouselMyQuizzArray) == 2) {
                    $previousLink='';
                    $previousQuizz='';
                    $quizzShown=quizzDivMaker($carrouselMyQuizzArray[1]);
                    $nextQuizz='';
                    $nextLink='';
                }elseif( count($carrouselMyQuizzArray) == 3 ) {
                    $previousLink=isset($carrouselMyQuizzArray[2])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?quizz='.(2).'">Quizz précédent</a></div>':'';
                    $previousQuizz=quizzDivMaker($carrouselMyQuizzArray[count($carrouselMyQuizzArray)-1]);
                    $quizzShown=quizzDivMaker($carrouselMyQuizzArray[1]);
                    $nextQuizz=quizzDivMaker($carrouselMyQuizzArray[2]);
                    $nextLink=isset($carrouselMyQuizzArray[2])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?quizz='.(2).'">Quizz suivant</a></div>':'';
                }elseif(count($carrouselMyQuizzArray) >= 4) {
                    $previousLink=isset($carrouselMyQuizzArray[count($carrouselMyQuizzArray)-1])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?quizz='.(count($carrouselMyQuizzArray)-1).'">Quizz précédent</a></div>':'';
                    $previousQuizz=quizzDivMaker($carrouselMyQuizzArray[1]);
                    $quizzShown=quizzDivMaker($carrouselMyQuizzArray[2]);
                    $nextQuizz=quizzDivMaker($carrouselMyQuizzArray[3]);
                    $nextLink=isset($carrouselMyQuizzArray[3])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?quizz='.(3).'">Quizz suivant</a></div>':'';
                }
            
                if(isset($_GET['quizz']) and is_int((int)$_GET['quizz'])){
                    if(array_key_exists($_GET['quizz'],$carrouselMyQuizzArray)){
                        if($_GET['quizz'] == 1){
                            $previousLink=isset($carrouselMyQuizzArray[count($carrouselMyQuizzArray)-1])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?quizz='.(count($carrouselMyQuizzArray)-1).'">Quizz précédent</a></div>':'';
                            $previousQuizz=quizzDivMaker($carrouselMyQuizzArray[count($carrouselMyQuizzArray)-1]);
                            $quizzShown=quizzDivMaker($carrouselMyQuizzArray[$_GET['quizz']]);
                            $nextQuizz=quizzDivMaker($carrouselMyQuizzArray[$_GET['quizz']+1]);
                            $nextLink=isset($carrouselMyQuizzArray[$_GET['quizz']+1])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?quizz='.($_GET['quizz']+1).'">Quizz suivant</a></div>':'';
                            
                        }elseif($_GET['quizz'] == count($carrouselMyQuizzArray)-1){
                            $previousLink=isset($carrouselMyQuizzArray[$_GET['quizz']-1])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?quizz='.($_GET['quizz']-1).'">Quizz précédent</a></div>':'';
                            $previousQuizz=quizzDivMaker($carrouselMyQuizzArray[$_GET['quizz']-1]);
                            $quizzShown=quizzDivMaker($carrouselMyQuizzArray[$_GET['quizz']]);
                            $nextQuizz=quizzDivMaker($carrouselMyQuizzArray[1]);
                            $nextLink=isset($carrouselMyQuizzArray[1])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?quizz='.(1).'">Quizz suivant</a></div>':'';
                        }else{
                            $previousLink=isset($carrouselMyQuizzArray[$_GET['quizz']-1])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?quizz='.($_GET['quizz']-1).'">Quizz précédent</a></div>':'';
                            $previousQuizz=quizzDivMaker($carrouselMyQuizzArray[$_GET['quizz']-1]);
                            $quizzShown=quizzDivMaker($carrouselMyQuizzArray[$_GET['quizz']]);
                            $nextQuizz=quizzDivMaker($carrouselMyQuizzArray[$_GET['quizz']+1]);
                            $nextLink=isset($carrouselMyQuizzArray[$_GET['quizz']+1])?'<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?quizz='.($_GET['quizz']+1).'">Quizz suivant</a></div>':'';
                        }
                    }
                }
                echo $previousLink;
                echo $previousQuizz;
                echo $quizzShown;
                echo $nextQuizz;
                echo $nextLink;
            }
            echo '</div>';
        ?>
            </div>
            <div class=" banner">
                <?php echo "<img class='houseIcone $currentHouse' src='GriffondorIcone.png'>" ?>
            </div>
    </div>
    <?php
    
    ?>
    </div>
    <?php
    
    ?>

    <?php
    require('footer.php');
    ?>
    </div>
    </div>
</body>

</html>