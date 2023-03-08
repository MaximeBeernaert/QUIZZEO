class CreateQuizz {
    constructor() {
        this.addQuestion = document.querySelector('.addQuestion')
        this.removeQuestion = document.querySelector('.removeQuestion')
        this.removeAnswer = document.querySelector('.removeAnswer')
        this.numberQuestion = 0
        this.checkPreviousQuestions();
        this.addQuestion.addEventListener('click', () => { this.addQuestionJS() } )
        this.removeQuestion.addEventListener('click', () => { this.removeQuestionJS() } )
        this.removeAnswer.addEventListener('click', () => { this.removeAnswerJS() } )
    }

    checkPreviousQuestions() {
        const elementQuestion = document.querySelectorAll('.DivQuestion')
        for(let i_question=1; i_question<=elementQuestion.length; i_question++){
            this.numberQuestion = i_question
        }

        const elementAnswer = document.querySelectorAll('.DivAnswer')
        let length = elementAnswer.length

        for(let i=1; i<=length; i++){
            const element = document.querySelector(`.DivAnswerButton${i}`)

            const addAnswer = document.createElement('input')
            addAnswer.type = 'button'
            addAnswer.id = `addAnswer${i}`
            addAnswer.value = `Ajouter une réponse ${i}`
            addAnswer.className = `Button${i}`
            addAnswer.addEventListener('click', () => { this.addAnswerJS(addAnswer.className) } )

            element.appendChild(addAnswer);
        }
    }

    addQuestionJS() {
        
        const elementQuestion = document.querySelectorAll('.DivQuestion')
        
        this.numberQuestion = elementQuestion.length+1

        this.numberAnswer = 0
        const newDiv = document.createElement("div")
        newDiv.className = `DivQuestion DivQuestion${this.numberQuestion}`

        const newQuestionTitle = document.createTextNode(`Question ${this.numberQuestion} - Entrer la question : `)
        const newQuestion = document.createElement('input')
        newQuestion.type = 'text'
        newQuestion.className = `Question${this.numberQuestion}`
        newQuestion.name = `Question${this.numberQuestion}`
        newQuestion.required = true
        
        const rightAnswerText = document.createTextNode(` Entrer la bonne réponse : `)
        const rightAnswer = document.createElement('input')
        rightAnswer.type = 'text'
        rightAnswer.className = `rightAnswer${this.numberQuestion}`
        rightAnswer.name = `rightAnswer${this.numberQuestion}`
        rightAnswer.required = true

        const newDivWrongAnswer = document.createElement("div")
        newDivWrongAnswer.className = `DivAnswer-0`

        const wrongAnswerText = document.createTextNode(` Entrer la première mauvaise réponse : `)
        const newAnswer = document.createElement('input')
        newAnswer.type = 'text'
        newAnswer.className = `Answer0`
        newAnswer.name = `AnswerButton${this.numberQuestion}0`
        newAnswer.required = true

        const divAnswerButton = document.createElement("div")
        divAnswerButton.className = `DivAnswerButton${this.numberQuestion}`

        const addAnswer = document.createElement('input')
        addAnswer.type = 'button'
        addAnswer.id = `addAnswer${this.numberQuestion}`
        addAnswer.value = `Ajouter une réponse ${this.numberQuestion}`
        addAnswer.className = `Button${this.numberQuestion}`
        addAnswer.addEventListener('click', () => { this.addAnswerJS(addAnswer.className) } )

        newDiv.appendChild(newQuestionTitle)
        newDiv.appendChild(newQuestion)
        newDiv.appendChild(rightAnswerText)
        newDiv.appendChild(rightAnswer)
        newDiv.appendChild(wrongAnswerText)
        newDivWrongAnswer.appendChild(newAnswer)
        newDiv.appendChild(newAnswer)
        divAnswerButton.appendChild(addAnswer)
        newDiv.appendChild(divAnswerButton)
        
       
        
        const element = document.querySelector('.form1')
        const currentDiv = element.querySelector('.addQuestions')
        element.insertBefore(newDiv, currentDiv)
        
        const element1 = document.querySelector('.form1')
        const currentDiv1 = element1.querySelector('.addQuestions')
        element1.insertBefore(newDiv, currentDiv1)
    }

    addAnswerJS(buttonNumber) {
        let number = buttonNumber.replace("Button", "")
        const element = document.querySelector(`.DivAnswer${buttonNumber}`)
        this.numberAnswer = 1
        for(let i=1; i<=element.childElementCount; i++){
            this.numberAnswer = i
        }
        
        const newDiv = document.createElement("div")
        newDiv.className = `DivAnswer${number} DivAnswer-${this.numberAnswer}`

        const newAnswer = document.createElement('input')
        newAnswer.type = 'text'
        newAnswer.className = `Answer${this.numberAnswer}`
        newAnswer.name = `Answer${buttonNumber}${this.numberAnswer}`
        newAnswer.required = true

        newDiv.appendChild(newAnswer)
        
        const currentDiv = document.querySelector(`.DivAnswer${buttonNumber}`)
        currentDiv.appendChild(newDiv)
    }

    removeQuestionJS(){
        const elementQuestionNumber = document.querySelectorAll('.DivQuestion')
        this.lastQuestion = elementQuestionNumber.length
        if(this.lastQuestion > 1) {
            const elementLast = document.querySelector(`.DivQuestion${this.lastQuestion}`)
            elementLast.remove()
        }
    }
    removeAnswerJS(){
        const elementQuestionNumber = document.querySelectorAll('.DivQuestion')
        this.lastQuestion = elementQuestionNumber.length

        const elementAnswerNumber = document.querySelectorAll(`.DivAnswer${this.lastQuestion}`)
        this.lastAnswer = elementAnswerNumber.length

        if(this.lastAnswer != 0){
            const elementLast = document.querySelector(`.DivAnswer-${this.lastAnswer}`)
            elementLast.remove()
        }
        
    }
}

let createQuizz = new CreateQuizz() 