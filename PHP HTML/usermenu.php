<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu utilisateur</title>
</head>
<script>
    // Script to keep the scrolling position of the page when it is reloaded (by the carrousel of quiz)
    document.addEventListener("DOMContentLoaded", function(event) {
        // check if localStorage.getItem('scrollpos') exist
        var scrollpos = localStorage.getItem('scrollpos');
        if (scrollpos) {
            // if yes, the page moves to the scrolling position
            window.scrollTo(0, scrollpos);
        }
    });
    window.onbeforeunload = function(e) {
        // on unload of page, we put the scroll position in the localStorage
        localStorage.setItem('scrollpos', window.scrollY);
    };
</script>

<body>
    <header>
        <!-- we call for the header.php for the header HTML and the CSS -->
        <?php
        require('header.php');
        ?>
    </header>
    <?php
    function quizzDivMaker($id_quizz,$conn)
    {
        // Every times a quiz has to be created, we create it here. 
        if ($id_quizz == "<div></div>") {
            return $id_quizz;
        } else {
            // We select it from the database, get its title, theme and difficulty
            $query = "SELECT * FROM `quizz` WHERE id_quizz='$id_quizz'";
            $result = mysqli_query($conn, $query);
            $quizz = mysqli_fetch_assoc($result);
            $title_quizz = $quizz['titre_quizz'];
            $theme_quizz = $quizz['theme_quizz'];
            $modif = '';

            // with the difficulty, we put stars on the div card
            $star = "<i class='diffilculteStarMainQuizz'>&#9733;</i>";
            $diff = "<div class='starDiv'>";
            if ($quizz['difficulte_quizz'] == 1) {
                $diff .= $star;
            } elseif ($quizz['difficulte_quizz'] == 2) {
                $diff .= $star . $star;
            } elseif ($quizz['difficulte_quizz'] == 3) {
                $diff .= $star . $star . $star;
            } elseif ($quizz['difficulte_quizz'] == 4) {
                $diff .= $star . $star . $star . $star;
            } elseif ($quizz['difficulte_quizz'] == 5) {
                $diff .= $star . $star . $star . $star . $star;
            }
            $diff .= "</div>";

            $user = $_SESSION['user'];
            $id_user = $user['id_utilisateur'];
            $query = "SELECT * FROM `quizz` WHERE id_quizz='$id_quizz' AND auteur_quizz='$id_user'";
            // Next we check if the user is the owner or the admin of the site, so they can have access to Modify/Delete buttons
            $result = mysqli_query($conn, $query);
            if ($quizz = mysqli_fetch_assoc($result)) {
                $modif = "<form action='modif.php' method='POST'>
                <input type='hidden' name='id_quizz' value='$id_quizz'>
                <button type='submit' name='modify2-quizz-btn' class='quizzButton modify2-quizz-btn'>Modifier</button>
            </form>
            <form action='usermenu.php' method='POST'>
                <input type='hidden' name='id_quizz' value='$id_quizz'>
                <button type='submit' name='delete2-quizz-btn' class='quizzButton delete2-quizz-btn'>Supprimer</button>
            </form>";
            }
            if ($user['type_utilisateur'] == 2) {
                $modif = "<form action='modif.php' method='POST'>
                <input type='hidden' name='id_quizz' value='$id_quizz'>
                <button type='submit' name='modify2-quizz-btn' class='quizzButton modify2-quizz-btn'>Modifier</button>
            </form>
            <form action='usermenu.php' method='POST'>
                <input type='hidden' name='id_quizz' value='$id_quizz'>
                <button type='submit' name='delete2-quizz-btn' class='quizzButton delete2-quizz-btn'>Supprimer</button>
            </form>";
            }

            // we put everything in a template of divs and the quiz is created. 

            return "<div class='quizz'>
                <div class='titlequizzmainpage'>
                    $title_quizz
                </div>
                <div class='themequizzmainpage'>
                    $theme_quizz
                </div>
                <div class='diffquizzmainpage'>
                    $diff
                </div>
                <div class='quizzPlay'>
                    <form action='quizz.php' method='POST'>
                        <input type='hidden' name='id_quizz' value='$id_quizz'>
                        <button type='submit' name='choose2-quizz-btn' class='quizzButton choose2-quizz-btn'>Jouer !</button>
                    </form>
                    $modif
                </div>
                </div>";
        }
    }
    function checkSuppression()
    {
        // we create a form if the user has clicked on a quiz suppression button
        if (isset($_POST['id_quizz'])) {
            $id_quizz = $_POST['id_quizz'];
            echo "
                        <br>
                        <div class='suppressionMenu'>
                        <p>Êtes-vous sûr de vouloir supprimer ce quizz ?</p>
                        <div class='suppressionMenuButton'>
                        <form action='usermenu.php' method='POST'>
                            <input type='hidden' name='id_quizz' value='$id_quizz'>
                            <button type='submit' name='confirm-delete-btn' class='confirm-delete-btn buttonRed'>Oui</button>
                        </form>
                        <form action='usermenu.php' method='POST'>
                            <button type='submit' name='buttonBlack cancel-delete-btn' class='buttonBlack cancel-delete-btn'>Non</button>
                        </form>
                        </div>
                        </div>
                        <br>";
                        // if confirmed, it will launch the suppression()
        }
    }
    function suppression($conn)
    {
        // here we suppress the quiz targeted with an sql query
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

            // and refresh the page
            echo ("<meta http-equiv='refresh' content='1'>");
        }
    }
    // we create the carrousel here
    function carrouselMaker($carrouselMyQuizzArray, $get,$conn)
    {
        $previousLink = '';
        $quizzShown = $carrouselMyQuizzArray[1];
        // depending on the arraysize, there will be one, two or three (and thus more) quiz shown on screen
        // with each quiz id stored in the array, we create a 'quiz div' displaying the quiz infos.
        // if the quiz array is longer than 2, we create two buttons on the side of the carrousel, so we can navigate throught the quiz.
        if (count($carrouselMyQuizzArray) == 2) {
            $quizzShown = quizzDivMaker($carrouselMyQuizzArray[1],$conn);
            return $quizzShown;
        } elseif (count($carrouselMyQuizzArray) == 3) {
            $quizzShown = quizzDivMaker($carrouselMyQuizzArray[1],$conn);
            $nextQuizz = quizzDivMaker($carrouselMyQuizzArray[2],$conn);
            return $quizzShown . $nextQuizz;
        } elseif (count($carrouselMyQuizzArray) >= 4) {
            $previousLink = isset($carrouselMyQuizzArray[count($carrouselMyQuizzArray) - 1]) ? '<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?' . $get . '=' . (count($carrouselMyQuizzArray) - 1) . '">Quizz précédent</a></div>' : '';
            $previousQuizz = quizzDivMaker($carrouselMyQuizzArray[1],$conn);
            $quizzShown = quizzDivMaker($carrouselMyQuizzArray[2],$conn);
            $nextQuizz = quizzDivMaker($carrouselMyQuizzArray[3],$conn);
            $nextLink = isset($carrouselMyQuizzArray[3]) ? '<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?' . $get . '=' . (3) . '">Quizz suivant</a></div>' : '';
            if (isset($_GET[$get]) and is_int((int)$_GET[$get])) {
                if (array_key_exists($_GET[$get], $carrouselMyQuizzArray)) {
                    if ($_GET[$get] == 1) {
                        $previousLink = isset($carrouselMyQuizzArray[count($carrouselMyQuizzArray) - 1]) ? '<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?' . $get . '=' . (count($carrouselMyQuizzArray) - 1) . '">Quizz précédent</a></div>' : '';
                        $previousQuizz = quizzDivMaker($carrouselMyQuizzArray[count($carrouselMyQuizzArray) - 1],$conn);
                        $quizzShown = quizzDivMaker($carrouselMyQuizzArray[$_GET[$get]],$conn);
                        $nextQuizz = quizzDivMaker($carrouselMyQuizzArray[$_GET[$get] + 1],$conn);
                        $nextLink = isset($carrouselMyQuizzArray[$_GET[$get] + 1]) ? '<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?' . $get . '=' . ($_GET[$get] + 1) . '">Quizz suivant</a></div>' : '';
                    } elseif ($_GET[$get] == count($carrouselMyQuizzArray) - 1) {
                        $previousLink = isset($carrouselMyQuizzArray[$_GET[$get] - 1]) ? '<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?' . $get . '=' . ($_GET[$get] - 1) . '">Quizz précédent</a></div>' : '';
                        $previousQuizz = quizzDivMaker($carrouselMyQuizzArray[$_GET[$get] - 1],$conn);
                        $quizzShown = quizzDivMaker($carrouselMyQuizzArray[$_GET[$get]],$conn);
                        $nextQuizz = quizzDivMaker($carrouselMyQuizzArray[1],$conn);
                        $nextLink = isset($carrouselMyQuizzArray[1]) ? '<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?' . $get . '=' . (1) . '">Quizz suivant</a></div>' : '';
                    } else {
                        $previousLink = isset($carrouselMyQuizzArray[$_GET[$get] - 1]) ? '<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?' . $get . '=' . ($_GET[$get] - 1) . '">Quizz précédent</a></div>' : '';
                        $previousQuizz = quizzDivMaker($carrouselMyQuizzArray[$_GET[$get] - 1],$conn);
                        $quizzShown = quizzDivMaker($carrouselMyQuizzArray[$_GET[$get]],$conn);
                        $nextQuizz = quizzDivMaker($carrouselMyQuizzArray[$_GET[$get] + 1],$conn);
                        $nextLink = isset($carrouselMyQuizzArray[$_GET[$get] + 1],$conn) ? '<div class="carrouselButton"><a class="buttonBlack" href="usermenu.php?' . $get . '=' . ($_GET[$get] + 1) . '">Quizz suivant</a></div>' : '';
                    }
                }
            }
            return $previousLink . $previousQuizz . $quizzShown . $nextQuizz . $nextLink;
        }
    }

// Then we call for the current colors (out of the SESSION cookies) chosen by the user (if not set, we put Serpentard>Griffondor colors)
    if (isset($_COOKIE['currentHouse'])) {
        $currentHouse = str_replace("houseButton ", "", $_COOKIE['currentHouse']);
    } else {
        $currentHouse = 'Serpentard';
    }
    ?>
    <!-- Main page, where the banners and the carrousels of quiz will be -->
    <div class="mainPage">
        <!-- first banner -->
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
            <!-- here we make the two carrousels -->
                <div class="usermenuQuizzList">Mes quizz :</div>
            <?php
    // first carrousel : 
                $query = "SELECT * FROM `quizz` WHERE auteur_quizz='$id_utilisateur'";
                $result = mysqli_query($conn, $query);
                $carrouselMyQuizzArray = [0];
                // we add each quiz that the user made in an array
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($carrouselMyQuizzArray, $row['id_quizz']);
                }
                echo '<div class="carrouselMyQuizz">';
                // if there is no quiz, 'you have no quiz'
                // else, we make the carrousel with the quiz array
                if (count($carrouselMyQuizzArray) == 1) {
                    echo "Tu n'as pas encore créé de quizz !";
                } elseif (count($carrouselMyQuizzArray) >= 2) {
                    echo carrouselMaker($carrouselMyQuizzArray, "myquizz",$conn);
                }
                echo '</div>';
            endif;
            // we check if the first delete button was pressed
            checkSuppression();
            // we check if the second delete button was pressed (and delete the targeted quiz)
            suppression($conn);
            ?>
            <div class="usermenuQuizzList">Tous les quizz :</div>
            <?php
    // second carrousel : 
            $query = "SELECT * FROM `quizz`";
            $result = mysqli_query($conn, $query);
            $carrouselMyQuizzArray = [0];
            // we add each quiz existing in an array
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($carrouselMyQuizzArray, $row['id_quizz']);
            }

            echo '<div class="carrouselMyQuizz">';
            // if there is no quiz, 'there is no quiz yet'
            // else, we make the carrousel with the quiz array
            if (count($carrouselMyQuizzArray) == 1) {
                echo "Il n'y a pas encore de quizz !";
            } else {
                echo carrouselMaker($carrouselMyQuizzArray, "quizz",$conn);
            }
            echo '</div><br><br>';
            ?>
        </div>
        <!-- second banner and footer -->
        <div class=" banner">
            <?php echo "<img class='houseIcone $currentHouse' src='GriffondorIcone.png'>" ?>
        </div>
    </div>
    </div>
    <?php
    require('footer.php');
    ?>
    </div>
    </div>
</body>

</html>