class create {
    constructor(){
        let questions = document.querySelectorAll(`.question`)
        this.displayQuestion(0,questions)
    }


    displayQuestion(numberQuestion,questions) {
        let questionsId = document.querySelectorAll(`.questionId${numberQuestion}`)
        let questionsText = document.querySelectorAll(`.questionText${numberQuestion}`)
        if(questionsId.length ==1) {
            let questionId = questionsId[0].value

            if(questionsText.length == 1) {

                let questionText = questionsText[0].value

                const newDivQuestion = document.createElement("div")
                newDivQuestion.className = `DivQuestion${numberQuestion}`
                newDivQuestion.id = `DivQuestion${numberQuestion}`
        
                const newQuestionText = document.createTextNode(`${questionText}`) 
        
                newDivQuestion.appendChild(newQuestionText)



                let answersId = document.querySelectorAll(`.answerIdQ${numberQuestion}`)
                let answersText = document.querySelectorAll(`.answerTextQ${numberQuestion}`)

                const newDivAnswer = document.createElement("div")
                newDivAnswer.className = `DivAnswers${numberQuestion}`

                const newSelect = document.createElement("select")
                newSelect.setAttribute("id",`select${numberQuestion}`)

                for(let i=0;i<answersId.length;i++) {

                    const newQuestionAnswer = document.createTextNode(`${answersText[i].value}`) 
                    newDivAnswer.appendChild(newQuestionAnswer)

                    const newOptionAnswer = document.createElement("option")
                    newOptionAnswer.setAttribute("value",`${answersId[i].value}`)
                    const newOptionText = document.createTextNode(`${answersText[i].value}`)
                    newOptionAnswer.appendChild(newOptionText)
                    newSelect.appendChild(newOptionAnswer)
                }
                
                newDivQuestion.appendChild(newDivAnswer)
                
                newDivQuestion.appendChild(newSelect)
                const confirmButton = document.createElement('input')
                confirmButton.type = 'button'
                confirmButton.id = `Confirm`
                confirmButton.value = `Confirm`
                confirmButton.className = `Confirm`
                confirmButton.addEventListener('click', () => { this.newQuestion(questions,numberQuestion) } )

                newDivQuestion.appendChild(confirmButton)

                const element1 = document.querySelector('.table1')
                const currentDiv1 = document.querySelector('.src')
                element1.insertBefore(newDivQuestion, currentDiv1)
            }
        }        
        // Si questionText ou questionId existe pas : erreur
        
    }

    newQuestion(questions,numberQuestion) {
        var answerSelected = document.getElementById(`select${numberQuestion}`);
        var answerValue = answerSelected.value;
        this.createCookie(`cookieAnswer${numberQuestion}`,`${answerValue}`,"1")

        var elem = document.getElementById(`DivQuestion${numberQuestion}`);
        elem.remove();

        numberQuestion++
        if(numberQuestion<questions.length){
            this.displayQuestion(numberQuestion,questions)
        } else {
            window.location.replace("http://localhost/QUIZZEO/PHP%20HTML/quizzEnd.php");
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

$create = new create()