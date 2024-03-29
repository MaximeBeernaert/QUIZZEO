<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <!-- we call for the header.php for the header HTML and the CSS -->
        <?php
        require('header.php');
        ?>
    </header>
    <?php
    // Then we call for the current colors (out of the SESSION cookies) chosen by the user (if not set, we put Serpentard>Griffondor colors)
    if (isset($_COOKIE['currentHouse'])) {
        $currentHouse = str_replace("houseButton ", "", $_COOKIE['currentHouse']);
    } else {
        $currentHouse = 'Serpentard';
    }
    // we check if the user is here with a quiz ID
    if (!isset($_SESSION['id_quizz'])) {
        header("Location:usermenu.php");
    }
    ?>
    <div class="mainPage">
        <div class="banner">
            <?php echo "<img class='houseIcone $currentHouse' src='GriffondorIcone.png'>" ?>
        </div>
        <?php
        // this function is to check if the string doesn't have single quotes - for use in the sql query later on.
        function stringCheck($string)
        {
            $needle = "'";
            $replace = "''";
            $lastPos = 0;
            $positions = array();

            while (($lastPos = strpos($string, $needle, $lastPos)) !== false) {
                $positions[] = $lastPos;
                $lastPos = $lastPos + strlen($needle);
            }
            $stringChecked = $string;
            foreach ($positions as $value) {
                $stringChecked = str_replace($needle, $replace, $string);
            }
            return $stringChecked;
        }
        function createQuizzArray($title)
        {
            $quizz_diff = $_POST['hiddenQuizzDiff'];
            $quizzSave = array(array($title, $quizz_diff, stringCheck($_POST['themequizz'])));
            $numberQuestion = 1;
            while (isset($_POST["Question" . $numberQuestion])) {
                $question = array();
                array_push($question, stringCheck($_POST["Question" . $numberQuestion]));
                array_push($question, stringCheck($_POST["rightAnswer" . $numberQuestion]));
                $numberAnswer = 0;
                while (isset($_POST["AnswerButton" . $numberQuestion . $numberAnswer])) {

                    array_push($question, stringCheck($_POST["AnswerButton" . $numberQuestion . $numberAnswer]));
                    $numberAnswer += 1;
                }

                array_push($quizzSave, $question);
                $numberQuestion += 1;
            }
            $_SESSION['quizzSave'] = $quizzSave;
            return $quizzSave;
        }

        function checkForTitle($conn, $title)
        {
            if ($title == null) {
                echo "<h3>Titre de quizz vide.</h3><br/>";
                titleAlreadyTaken();
                return FALSE;
            }
            $query  = "SELECT * FROM `quizz` WHERE titre_quizz='$title'";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_num_rows($result);
            if ($rows >= 1) {
                echo "<h3>Titre de quizz déjà pris.</h3><br/>";
                titleAlreadyTaken();
                return FALSE;
            }
            return TRUE;
        }

        function titleAlreadyTaken()
        {
            echo "  <form class='form1' action='savequizz.php' method='post'> 
              <input type='text' class='quizztitlerenamed' name='quizztitlerenamed' placeholder='Renommez votre quizz' required />
              <input type='submit' name='submit' value='Valider' class='submit-button'>
            </form>";
        }

        //Have the quizzer totally validate his choice. He can modify one last time here. 
        function checkQuizzForValidation($quizzSave, $conn)
        {
            $numberQuestion = 1;
            while (isset($quizzSave[$numberQuestion])) {
                $question_text = $quizzSave[$numberQuestion][0];
                echo "<br>Question " . $numberQuestion . " : <br>";
                $numberAnswer = 0;
                while (isset($quizzSave[$numberQuestion][$numberAnswer])) {
                    echo $quizzSave[$numberQuestion][$numberAnswer] . "<br>";
                    $numberAnswer += 1;
                }
                $numberQuestion += 1;
            }
        }

        function createQuizz($quizzSave, $conn)
        {
            $user = $_SESSION['user'];
            $user_id = $user['id_utilisateur'];
            $title = $quizzSave[0][0];
            $quizz_diff = $quizzSave[0][1];
            $theme_quizz = $quizzSave[0][2];

            //INSERT un nouveau quizz avec le titre récupéré à la page d'avant (createquizz.php) et le reste des infos (utilisateurs etc.) ID_quizz A-I
            $query = "INSERT INTO `quizz`(`titre_quizz`, `difficulte_quizz`, `theme_quizz`,`auteur_quizz`) 
                 VALUES ('$title','$quizz_diff','$theme_quizz',$user_id)";
            $result = mysqli_query($conn, $query);
            if ($result) {
        ?>

                <body>
                    <h1>QUIZZEO</h1>
                    <p>Votre questionnaire a été enregistré</p>
                </body>
            <?php
            } else {
                header("Location:quizznotsaved.php");
            }
            $query = "SELECT * FROM `quizz` WHERE titre_quizz='$title'";
            $result = mysqli_query($conn, $query);
            $quizz = mysqli_fetch_assoc($result);
            $id_quizz = $quizz['id_quizz'];
            echo $id_quizz;

            checkQuizzForValidation($quizzSave, $conn);
            $numberQuestion = 1;
            while (isset($quizzSave[$numberQuestion])) {
                $question_text = $quizzSave[$numberQuestion][0];

                //Create the question in the database
                $query = "INSERT INTO `questions`(`intitule_question`, `type_question`) VALUES ('$question_text','1')";
                $result = mysqli_query($conn, $query);

                //Select the question created in the Database
                $query = "SELECT * FROM `questions` WHERE intitule_question='$question_text'";
                $result = mysqli_query($conn, $query);
                while ($question = mysqli_fetch_assoc($result)) {
                    $id_question = $question['id_question'];
                }

                //Create the link between the question and the quizz in the database
                $query = "INSERT INTO `contient`(`id_quizz`, `id_question`) VALUES ('$id_quizz','$id_question')";
                $result = mysqli_query($conn, $query);


                $answer_text = $quizzSave[$numberQuestion][1];
                //Create the answer in the database
                $query = "INSERT INTO `choix`(`reponse_choix`, `bonne_reponse_choix`) VALUES ('$answer_text','1')";
                $result = mysqli_query($conn, $query);

                //Select the answer created in the Database
                $query = "SELECT * FROM `choix` WHERE reponse_choix='$answer_text' AND bonne_reponse_choix='1'";
                $result = mysqli_query($conn, $query);
                while ($answer = mysqli_fetch_assoc($result)) {
                    $id_answer = $answer['id_choix'];
                }


                //Create the link between the question and the quizz in the database
                $query = "INSERT INTO `appartenir`(`ID_question`, `ID_choix`) VALUES ('$id_question','$id_answer')";
                $result = mysqli_query($conn, $query);

                $numberAnswer = 2;

                while (isset($quizzSave[$numberQuestion][$numberAnswer])) {
                    $answer_text = $quizzSave[$numberQuestion][$numberAnswer];

                    //Create the answer in the database
                    $query = "INSERT INTO `choix`(`reponse_choix`, `bonne_reponse_choix`) VALUES ('$answer_text','0')";
                    $result = mysqli_query($conn, $query);

                    //Select the answer created in the Database
                    $query = "SELECT * FROM `choix` WHERE reponse_choix='$answer_text' AND bonne_reponse_choix='0'";
                    $result = mysqli_query($conn, $query);
                    while ($answer = mysqli_fetch_assoc($result)) {
                        $id_answer = $answer['id_choix'];
                    }
                    //Create the link between the question and the quizz in the database
                    $query = "INSERT INTO `appartenir`(`ID_question`, `ID_choix`) VALUES ('$id_question','$id_answer')";
                    $result = mysqli_query($conn, $query);


                    $numberAnswer += 1;
                }


                $numberQuestion += 1;
            }
            if (!isset($_POST["Question" . $numberQuestion])) {
            ?>

                <body>
                    <p>Fin des questions</p>
                    <form class="form1" action="usermenu.php" method="post">
                        <input type="submit" name="submit" value="Valider" class="submit-button">
                    </form>
                </body>
        <?php
            }
        }
        $user = $_SESSION['user'];
        if ($user['type_utilisateur'] < 1) {
            header("Location:notpermited.php");
        }
        ?>
        <div class="form">
            <?php
            // Check for two cases : 
            // first is the title has been renamed (because it was already taken)
            // second is the first time the quizz is been registered
            // here is the first case : we check for a HTML node named 'quizztitlerenamed'
            if (isset($_POST['quizztitlerenamed'])) {
                // we get the saved quizz (done in the second case) and rename the quizz there
                $quizzSave = $_SESSION['quizzSave'];
                $a = $_POST['quizztitlerenamed'];
                $title = stringCheck($a);
                $quizzSave[0][0] = $title;
                // we then send for the quizz to be checked again, and if TRUE, then we save the quizz in the database

                if (checkForTitle($conn, $title)) {
                    createQuizz($quizzSave, $conn);
                }
            } else // second case here where we check the quizz first the first time
            {
                // we get the title of the quizz
                $a = $_POST['quizztitle'];
                $title = stringCheck($a);
                // we create the quizz, putting the valeus in an array to get it back in case of already taken title
                $quizzSave = createQuizzArray($title);
                // we then send for the quizz to be checked, and if TRUE, then we save the quizz in the database
                if (checkForTitle($conn, $title)) {
                    createQuizz($quizzSave, $conn);
                }
            }
            ?>
        </div>
        <div class="banner">
            <?php echo "<img class='houseIcone $currentHouse' src='GriffondorIcone.png'>" ?>
        </div>
    </div>
    <?php
    require('footer.php');
    ?>

</html>