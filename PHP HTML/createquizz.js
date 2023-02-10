class CreateQuizz {
    constructor() {
        this.addQuestion = document.querySelector('.addQuestion')
        this.addQuestion.addEventListener('click', () => { this.addQuestionJS() } )
        this.numberQuestion = 0
    }

    addQuestionJS() {
        this.numberQuestion += 1
        this.numberAnswer = 0
        const newDiv = document.createElement("div")
        newDiv.className = `DivQuestion${this.numberQuestion}`

        const newQuestionTitle = document.createTextNode(`Question ${this.numberQuestion} - Entrer la question : `)
        const newQuestion = document.createElement('input')
        newQuestion.type = 'text'
        newQuestion.className = `Question${this.numberQuestion}`

        const rightAnswerText = document.createTextNode(` Entrer la bonne réponse : `)
        const rightAnswer = document.createElement('input')
        rightAnswer.type = 'text'
        rightAnswer.className = `rightAnswer${this.numberQuestion}`

        const ligne = document.createElement('br')

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
        newDiv.appendChild(ligne)
        divAnswerButton.appendChild(addAnswer)
        newDiv.appendChild(divAnswerButton)
        
       
        
        const element = document.querySelector('.form1')
        const currentDiv = element.querySelector('.addQuestions')
        element.insertBefore(newDiv, currentDiv)
    }

    addAnswerJS(numberQuestion) {

        this.numberAnswer += 1
        const newDiv = document.createElement("div")
        newDiv.className = `DivAnswer-${this.numberAnswer}`

        const newAnswer = document.createElement('input')
        newAnswer.type = 'text'
        newAnswer.className = `Answer${this.numberAnswer}`

        newDiv.appendChild(newAnswer)
        
        const currentDiv = document.querySelector(`.DivAnswer${numberQuestion}`)
        currentDiv.appendChild(newDiv)
    }

}

let createQuizz = new CreateQuizz() 