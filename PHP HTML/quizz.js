  class create {
    constructor(){
        //we get every item with the 'question' selector : that is every question item with a text
        let questions = document.querySelectorAll(`.question`)
        //we then call the looping function to display
        this.displayQuestion(0,questions)
    }

    //this function's role is to create most of the work shown on the screen : making the question and displaying the possible answers
    displayQuestion(numberQuestion,questions) {
        //we select the question ID and text
        let questionsId = document.querySelectorAll(`.questionId${numberQuestion}`)
        let questionsText = document.querySelectorAll(`.questionText${numberQuestion}`)
        //length will be of 1
        if(questionsId.length ==1) {

            if(questionsText.length == 1) {
                const space = document.createElement('div')
                space.className = 'spaceDiv'

                //we get the value from the question's item (which is the question's text)
                let questionText = questionsText[0].value

                //we create a div to put all the answers in
                const newDivQuestion = document.createElement("div")
                newDivQuestion.className = `DivQuestion DivQuestion${numberQuestion}`
                newDivQuestion.id = `DivQuestion${numberQuestion}`
                
                const newQuestionText = document.createTextNode(`${questionText}`) 
        
                newDivQuestion.appendChild(newQuestionText)
                newDivQuestion.appendChild(space)



                let answersId = document.querySelectorAll(`.answerIdQ${numberQuestion}`)
                let answersText = document.querySelectorAll(`.answerTextQ${numberQuestion}`)

                const newDivAnswer = document.createElement("div")
                newDivAnswer.className = `DivAnswers DivAnswers${numberQuestion}`

                const newDiv = document.createElement("div")


                const newSelect = document.createElement("select")
                newSelect.setAttribute("id",`select${numberQuestion}`)

                

                //we create an option selector to get all the questions
                for(let i=0;i<answersId.length;i++) {
                    const textDiv = document.createElement('div')
                    textDiv.className = `textDiv`
                    const newQuestionAnswer = document.createTextNode(`${answersText[i].value}`)

                    textDiv.appendChild(newQuestionAnswer)
                    newDivAnswer.appendChild(textDiv)

                    
                    const newOptionAnswer = document.createElement("option")
                    newOptionAnswer.setAttribute("value",`${answersId[i].value}`)
                    const newOptionText = document.createTextNode(`${answersText[i].value}`)
                    newOptionAnswer.appendChild(newOptionText)
                    newOptionAnswer.appendChild(space)
                    newSelect.appendChild(newOptionAnswer)
                }
                
                newDivQuestion.appendChild(newDivAnswer)
                
                newDiv.appendChild(newSelect)
                newDivQuestion.appendChild(newDiv)
                const confirmButton = document.createElement('input')
                confirmButton.type = 'button'
                confirmButton.id = `buttonBlack Confirm`
                confirmButton.value = `Valider`
                confirmButton.className = `buttonBlack Confirm`
                confirmButton.addEventListener('click', () => { this.newQuestion(questions,numberQuestion) } )

                const newDiv1 = document.createElement("div")
                newDiv1.appendChild(confirmButton)
                newDivQuestion.appendChild(newDiv1)
                const element1 = document.querySelector('.table1')
                const currentDiv1 = document.querySelector('.src')
                element1.insertBefore(newDivQuestion, currentDiv1)
            }
        }        
        // Si questionText ou questionId existe pas : erreur
        
    }

    // this function is aimed at the transition and making the next question
    newQuestion(questions,numberQuestion) {
        // we get the choice of answer of the user
        var answerSelected = document.getElementById(`select${numberQuestion}`);
        var answerValue = answerSelected.value;
        // and create a cookie for future use
        this.createCookie(`cookieAnswer${numberQuestion}`,`${answerValue}`,"1")

        //we remove the Div question
        var elem = document.getElementById(`DivQuestion${numberQuestion}`);
        elem.remove();

        numberQuestion++
        if(numberQuestion<questions.length){
            // if there's still questions left, we display it with the function 
            this.displayQuestion(numberQuestion,questions)
        } else {
            // if not, we forward the user to the end of the quizz and the saving of the choices.
            window.location.replace("quizzEnd.php");
        }
    }

    // create a cookie to store the value of the answer chosen
    createCookie(name, value, days) {
        var expires;
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        else {
            expires = "";
        }
        document.cookie = escape(name) + "=" + 
            escape(value) + expires + "; path=/";
    }
}

//we create an object each time the page is loaded up.
$create = new create()