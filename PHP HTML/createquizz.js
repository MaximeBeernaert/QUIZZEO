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
        newQuestion.name = `Question${this.numberQuestion}`

        const rightAnswerText = document.createTextNode(` Entrer la bonne réponse : `)
        const rightAnswer = document.createElement('input')
        rightAnswer.type = 'text'
        rightAnswer.className = `rightAnswer${this.numberQuestion}`
        rightAnswer.name = `rightAnswer${this.numberQuestion}`

        const newDivWrongAnswer = document.createElement("div")
        newDivWrongAnswer.className = `DivAnswer-0`

        const wrongAnswerText = document.createTextNode(` Entrer la première mauvaise réponse : `)
        const newAnswer = document.createElement('input')
        newAnswer.type = 'text'
        newAnswer.className = `Answer0`
        newAnswer.name = `AnswerButton${this.numberQuestion}0`

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
        
        const element = document.querySelector('.form1')
        const currentDiv = element.querySelector('.addQuestions')
        element.insertBefore(newDiv, currentDiv)
    }

    addAnswerJS(numberQuestion) {
        const element = document.querySelector(`.DivAnswer${numberQuestion}`)
        this.numberAnswer = 1
        for(let i=1; i<=element.childElementCount; i++){
            console.log(i)
            this.numberAnswer = i
        }
        
        const newDiv = document.createElement("div")
        newDiv.className = `DivAnswer-${this.numberAnswer}`

        const newAnswer = document.createElement('input')
        newAnswer.type = 'text'
        newAnswer.className = `Answer${this.numberAnswer}`
        newAnswer.name = `Answer${numberQuestion}${this.numberAnswer}`

        newDiv.appendChild(newAnswer)
        
        const currentDiv = document.querySelector(`.DivAnswer${numberQuestion}`)
        currentDiv.appendChild(newDiv)
    }

}

let createQuizz = new CreateQuizz() 