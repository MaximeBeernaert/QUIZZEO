class CreateQuizz {
    constructor() {
        this.addQuestion = document.querySelector('.addQuestion')
        this.addQuestion.addEventListener('click', () => { this.addQuestionJS() })
    }

    //Create a new question and add it to the quizz
    addQuestion() {





    }

    // add the newly created element and its content into the DOM
    const currentDiv = document.querySelector('.addQuestions');
        document.body.insertBefore(newDiv, currentDiv);

}
}
let createQuizz = new CreateQuizz() 