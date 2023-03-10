class CreateQuizz {
    constructor() {
        this.addQuestion = document.querySelector('.addQuestion')
        this.addAnswer1 = document.querySelector('.Button1')
        this.removeQuestion = document.querySelector('.removeQuestion')
        this.removeAnswer1 = document.querySelector('.removeAnswer1')
        this.numberQuestion = 1
        this.addQuestion.addEventListener('click', () => { this.addQuestionJS() } )
        this.addAnswer1.addEventListener('click', () => { this.addAnswerJS("Button1") } )
        this.removeQuestion.addEventListener('click', () => { this.removeQuestionJS() } )
        this.removeAnswer1.addEventListener('click', () => { this.removeAnswerJS(this.removeAnswer1.name) } )
    }

    //this function add a question to the form and add a button to add an answer to the question and a button to remove an answer to the question
    addQuestionJS() {

        const elementQuestion = document.querySelectorAll('.DivQuestion')
        for(let i_question=1; i_question<=elementQuestion.length; i_question++){
            this.numberQuestion = i_question
        }

        const space = document.createElement('div')
        space.className = 'spaceDiv'
        
        this.numberQuestion++
        this.numberAnswer = 0
        const newDiv = document.createElement("div")
        newDiv.className = `DivQuestion DivQuestion${this.numberQuestion}`

        const questionText = document.createElement("p")
        const newQuestionTitle = document.createTextNode(`Question ${this.numberQuestion} - Entrer la question : `)
        questionText.appendChild(newQuestionTitle)

        const newQuestion = document.createElement('input')
        newQuestion.type = 'text'
        newQuestion.className = `Question${this.numberQuestion}`
        newQuestion.name = `Question${this.numberQuestion}`
        newQuestion.required = true

        const rightText = document.createElement("p")
        const rightAnswerText = document.createTextNode(` Entrer la bonne réponse : `)
        rightText.appendChild(rightAnswerText)

        
        const rightAnswer = document.createElement('input')
        rightAnswer.type = 'text'
        rightAnswer.className = `rightAnswer${this.numberQuestion}`
        rightAnswer.name = `rightAnswer${this.numberQuestion}`
        rightAnswer.required = true

        const newDivWrongAnswer = document.createElement("div")
        newDivWrongAnswer.className = `DivAnswer${this.numberQuestion}0`

        const wrongText = document.createElement("p")
        const wrongAnswerText = document.createTextNode(` Entrer la première mauvaise réponse : `)
        wrongText.appendChild(wrongAnswerText)

        
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
        addAnswer.value = `Ajouter une réponse à la question ${this.numberQuestion}`
        addAnswer.className = `Button${this.numberQuestion}`
        addAnswer.addEventListener('click', () => { this.addAnswerJS(addAnswer.className) } )

        const divAnswerRemove = document.createElement("div")
        divAnswerRemove.className = `DivAnswerRemove${this.numberQuestion}`

        const removeAnswer = document.createElement('input')
        removeAnswer.type = 'button'
        removeAnswer.id = `removeAnswer${this.numberQuestion}`
        removeAnswer.value = `Retirer une réponse à la question ${this.numberQuestion}`
        removeAnswer.className = `removeAnswer${this.numberQuestion}`
        removeAnswer.name = `removeAnswer${this.numberQuestion}`
        removeAnswer.addEventListener('click', () => { this.removeAnswerJS(removeAnswer.name) } )

        newDiv.appendChild(space)
        newDiv.appendChild(questionText)
        newDiv.appendChild(newQuestion)
        newDiv.appendChild(rightText)
        newDiv.appendChild(rightAnswer)
        newDiv.appendChild(wrongText)
        newDivWrongAnswer.appendChild(newAnswer)
        newDiv.appendChild(newAnswer)
        divAnswerButton.appendChild(addAnswer)
        divAnswerRemove.appendChild(removeAnswer)

        newDiv.appendChild(divAnswerButton)
        newDiv.appendChild(divAnswerRemove)
       
        
        const element = document.querySelector('.form')
        const currentDiv = element.querySelector('.spaceDivQuestion')
        element.insertBefore(newDiv, currentDiv)
    }

    //this function add an answer to the question and add a button to remove an answer to the question
    addAnswerJS(buttonNumber) {
        let number = buttonNumber.replace("Button", "")
        const element = document.querySelector(`.DivAnswer${buttonNumber}`)
        this.numberAnswer = 1
        for(let i=1; i<=element.childElementCount; i++){
            this.numberAnswer = i
        }
        if( this.numberAnswer <=8) {
            const newDiv = document.createElement("div")
            newDiv.className = `DivAnswer${number} DivAnswer${number}${this.numberAnswer}`
    
            const newAnswer = document.createElement('input')
            newAnswer.type = 'text'
            newAnswer.className = `Answer${this.numberAnswer}`
            newAnswer.name = `Answer${buttonNumber}${this.numberAnswer}`
            newAnswer.required = true

            newDiv.appendChild(newAnswer)
            
            const currentDiv = document.querySelector(`.DivAnswer${buttonNumber}`)
            currentDiv.appendChild(newDiv)
        }
        
    }

    removeQuestionJS(){
        const elementQuestionNumber = document.querySelectorAll('.DivQuestion')
        this.lastQuestion = elementQuestionNumber.length
        if(this.lastQuestion > 1) {
            const elementLast = document.querySelector(`.DivQuestion${this.lastQuestion}`)
            elementLast.remove()
        }
    }
    removeAnswerJS(classname){
        let number = classname.replace("removeAnswer", "")

        const elementAnswerNumber = document.querySelectorAll(`.DivAnswer${number}`)
        let lastAnswer = elementAnswerNumber.length

        if(lastAnswer != 0){
            const elementLast = document.querySelector(`.DivAnswer${number}${lastAnswer}`)
            elementLast.remove()
        }
    }
}

let createQuizz = new CreateQuizz() 