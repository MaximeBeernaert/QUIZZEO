<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Jouer au Quizz</title>
</head>

<body>
    <header>
        <?php
        require('header.php');
        ?>
    </header>
    <?php
    if( isset($_COOKIE['currentHouse'])) {
        $currentHouse = str_replace("houseButton ","",$_COOKIE['currentHouse']);
    }else{
        $currentHouse = 'Serpentard';
    }
    ?>
    <div class="mainPage">
        <div class="banner">
            <?php echo "<img class='houseIcone $currentHouse' src='GriffondorIcone.png'>" ?>
        </div>
        <div class="form">
    <table>
        <?php
        // the following lines are the generation of the quizz questions. 
        // we create a class Question

        class Question
        {
            private $text_question;
            private $id_question;
            public function __construct($text, $id)
            {
                $this->text_question = $text;
                $this->id_question = $id;
            }
            public function getTextQuestion()
            {
                return $this->text_question;
            }
            public function setTextQuestion($t)
            {
                $this->text_question = $t;
            }
            public function getIdQuestion()
            {
                return $this->id_question;
            }
            public function setIdQuestion($t)
            {
                $this->id_question = $t;
            }
        }
        // and a class Answer
        class Answer
        {
            private $text_answer;
            private $id_answer;
            public function __construct($text, $id)
            {
                $this->text_answer = $text;
                $this->id_answer = $id;
                $this->id_answer = $id;
            }
            public function getTextAnswer()
            {
                return $this->text_answer;
            }
            public function setTextAnswer($t)
            {
                $this->text_answer = $t;
            }
            public function getIdAnswer()
            {
                return $this->id_answer;
            }
            public function setIdAnswer($t)
            {
                $this->id_answer = $t;
            }
        }
        //the two classes above will be used to store information on each and every questions and answers the played quizz has
        function stringCheck($string)
        {
            $needle = "'";
            $replace = "`";
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

        // in this function we assemble the values of a quizz (questions and answers) in a 2D array : each question has multiple answers
        function createQuizz($conn, $id_quizz)
        {
            //get the quizz title
            $query = "SELECT * FROM `quizz` WHERE `id_quizz` = '$id_quizz'";
            $result = mysqli_query($conn, $query);
            $quizz = mysqli_fetch_assoc($result);
            echo $quizz['titre_quizz'];
            //get every questions that are linked to the quizz
            $query = "SELECT * FROM `contient` WHERE `id_quizz` = '$id_quizz'";
            $result = mysqli_query($conn, $query);

            $quizzArray = [];
            // while there's a question in the request, this code will run
            while ($row = mysqli_fetch_assoc($result)) {
                //we get the question ID
                $id_question = $row['id_question'];
                //we call the function createQuestion to make an object
                $question = createQuestion($conn, $row, $id_question);
                $questionArray = [];

                //we get every answers linked to that current question
                $queryQuestion = "SELECT * FROM `appartenir` WHERE `id_question` = '$id_question'";
                $resultQuestion = mysqli_query($conn, $queryQuestion);

                while ($rowQuestion = mysqli_fetch_assoc($resultQuestion)) {
                    //we get the question ID
                    $id_answer = $rowQuestion['id_choix'];
                    //we call the function to make an object 
                    $answer = createAnswer($conn, $rowQuestion, $id_answer);
                    // we add the object inside the question array
                    array_push($questionArray, $answer);
                }
                //we shuffle the question array so the answers never come in the same order
                shuffle($questionArray);
                // we add the question text at the start of the question array
                array_unshift($questionArray, $question);
                //we push the question array in the quizz array, making it a 2D array
                array_push($quizzArray, $questionArray);
            }
            return $quizzArray;
        }

        function createQuestion($conn, $row, $id_question)
        {
            // we create an object Question with the text and the ID of the question (from Database)
            $queryQuestion = "SELECT * FROM `questions` WHERE `id_question` = '$id_question'";
            $resultQuestion = mysqli_query($conn, $queryQuestion);
            $question = mysqli_fetch_assoc($resultQuestion);
            $intitule = $question['intitule_question'];
            $text_question = stringCheck($intitule);
            $question = new Question($text_question, $id_question);
            return $question;
        }
        function createAnswer($conn, $rowQuestion, $id_answer)
        {
            // we create an object Answer with the text and the ID of the answer (from Database)
            $queryAnswer = "SELECT * FROM `choix` WHERE `id_choix` = '$id_answer'";
            $resultAnswer = mysqli_query($conn, $queryAnswer);
            $answer = mysqli_fetch_assoc($resultAnswer);
            $intitule = $answer['reponse_choix'];
            $text_answer = stringCheck($intitule);
            $answer = new Answer($text_answer, $id_answer);
            return $answer;
        }
        // once the quizz array (with the questions and their answers) is made, we create the html page
        function createHTML($conn, $quizzArray)
        {
            $index1 = 0;
            // we will be putting all our informations in hidden inputs in our html, so the javascript is able to access them without them being visible.
            echo "<table name=table1 class=table1> <div name=hiddenValues class=hiddenValues>";
            // we get every question's id and text ...
            while (isset($quizzArray[$index1][0])) {
                $questionText = $quizzArray[$index1][0]->getTextQuestion();
                $questionId = $quizzArray[$index1][0]->getIdQuestion();
                // ...and create a hidden input to store them.
                echo "<input type='hidden' name='question questionText$index1' class='question questionText$index1' value='$questionText'>";
                echo "<input type='hidden' name='questionId$index1' class='questionId$index1' value='$questionId'>";
                $index2 = 1;
                // we get every answer of the question'sid and text ...
                while (isset($quizzArray[$index1][$index2])) {
                    $answerText = $quizzArray[$index1][$index2]->getTextAnswer();
                    $answerId = $quizzArray[$index1][$index2]->getIdAnswer();
                    // ...and create a hidden input to store them.
                    echo "<input type='hidden' name='answerTextQ$index1 answerText$index2' class='answerTextQ$index1 answerText$index2' value='$answerText'>";
                    echo "<input type='hidden' name='answerIdQ$index1 answerId$index2' class='answerIdQ$index1 answerId$index2' value='$answerId'>";
                    $index2++;
                }
                $index1++;
            }
            echo "</div></table>";
        }
        
        //Suppress all cookies except the 'user' one (cookies are used to store the answers chosen in a quizz)
        if (isset($_COOKIE)) {
            foreach ($_COOKIE as $name => $value) {
                if ($name != "PHPSESSID") // Name of the cookie 'User' we want to keep
                {
                    if($name != "currentHouse") {
                        setcookie($name, '', 1); // Better use 1 (for the time) to avoid time problems, like timezones
                        setcookie($name, '', 1, '/');
                    }
                }
            }
        }
        // we get the user informations via SESSION and the chosen quizz with the POST method (from last page)
        $user = $_SESSION['user'];
        $id_quizz = $_POST['id_quizz'];

        // we put the id of the quizz in the SESSION
        $_SESSION['id_quizz'] = $id_quizz;

        // we launch the code by creating the values for the quizz and then creating the html page
        $quizzArray = createQuizz($conn, $id_quizz);
        createHTML($conn, $quizzArray);


        ?>
        </div>
        <div class="banner">
                <?php echo "<img class='houseIcone $currentHouse' src='GriffondorIcone.png'>" ?>
            </div>
    </div>
        <?php
        require('footer.php');
?>
        <!-- we link the html page to quizz.js for a better question/answer implementation  -->
        <script name='src' src="quizz.js"></script>

</html>