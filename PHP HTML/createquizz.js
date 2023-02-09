class CreateQuizz {
    constructor() {
        this.addQuestion.addEventListener('click', this.addQuestion())




    }

    addQuestion() {
        // Création de la div qui contiendra la question

        let questionDiv = document.createElement('div')
        questionDiv.classList.add('questionDiv')

        // Création de l'input pour la question

        let questionInput = document.createElement('input')
        questionInput.classList.add('questionInput')
        questionInput.setAttribute('type', 'text')
        questionInput.setAttribute('placeholder', 'Question')

        // Création du bouton pour supprimer la question

        let deleteQuestion = document.createElement('button')
        deleteQuestion.classList.add('deleteQuestion')
        deleteQuestion.setAttribute('type', 'button')
        deleteQuestion.textContent = 'Delete'

        // Ajout des éléments à la div qui contient la question

        questionDiv.appendChild(questionInput)
        questionDiv.appendChild(answerInput)
        questionDiv.appendChild(deleteQuestion)
        questionDiv.appendChild(answersDiv)
        questionDiv.appendChild(addAnswer)

        // Ajout de la div qui contient la question à la div qui contient toutes les questions

        this.questions.appendChild(questionDiv)
    }

    addAnswer() {
        // Création de l'input pour une réponse

        let answer = document.createElement('input')
        answer.classList.add('answer')
        answer.setAttribute('type', 'text')
        answer.setAttribute('placeholder', 'Answer')

        // Création du bouton pour supprimer une réponse

        let deleteAnswer = document.createElement('button')
        deleteAnswer.classList.add('deleteAnswer')
        deleteAnswer.setAttribute('type', 'button')
        deleteAnswer.textContent = 'Delete'

        // Ajout des éléments à la div qui contient la réponse

        answersDiv.appendChild(answer)
        answersDiv.appendChild(deleteAnswer)

        // Ajout de la div qui contient la réponse à la div qui contient toutes les réponses

        this.answers.appendChild(answersDiv)

    }






}