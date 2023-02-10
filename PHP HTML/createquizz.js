class CreateQuizz {
    constructor() {
        this.addQuestion = document.querySelector('.addQuestion')
        this.addQuestion.addEventListener('click', () => { this.addQuestionJS() } )
        this.numberQuestion = 0
        this.numberAnswer = 0
    }

    addQuestionJS() {
        this.numberQuestion += 1
        const newDiv = document.createElement("div")
        newDiv.className = `DivQuestion${this.numberQuestion}`

        const newQuestionTitle = document.createTextNode(`Question ${this.numberQuestion} - Entrer la question : ee `)
        const newQuestion = document.createElement('input')
        newQuestion.type = 'text'
        newQuestion.className = `Question${this.numberQuestion}`

        const ligne = document.createElement('br')

        

        const divAnswerButton = document.createElement("div")
        divAnswerButton.className = `DivAnswerButton${this.numberQuestion}`

        const addAnswer = document.createElement('input')
        addAnswer.type = 'button'
        addAnswer.id = `addAnswer${this.numberQuestion}`
        addAnswer.value = 'Ajouter une réponse'
        addAnswer.className = `button${this.numberQuestion}`
        addAnswer.addEventListener('click', () => { this.addAnswerJS() } )

        newDiv.appendChild(newQuestionTitle)
        newDiv.appendChild(newQuestion)
        newDiv.appendChild(ligne)
        newDiv.appendChild(divAnswerButton)
        newDiv.appendChild(addAnswer)
       
        const currentDiv = document.querySelector('.addQuestions')
        document.body.insertBefore(newDiv, currentDiv)
    }

    addAnswerJS() {
        this.numberAnswer += 1
        const newDiv = document.createElement("div")
        newDiv.className = `DivAnswer${this.numberAnswer}`

        this.numberAnswer += 1
        const newAnswer = document.createElement('input')
        newAnswer.type = 'text'
        newAnswer.className = `Answer${this.numberAnswer}`

        newDiv.appendChild(newAnswer)
        const currentDiv = document.querySelector(`.divAnswerButton${this.numberQuestion}`)
        document.body.insertBefore(newDiv, currentDiv)
    }

}

let createQuizz = new CreateQuizz() 