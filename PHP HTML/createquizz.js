class CreateQuizz {
    constructor() {
        this.addQuestion = document.querySelector('.addQuestion')
        this.addQuestion.addEventListener('click', () => { this.addQuestionJS() } )
    }

    addQuestion() {
        // create a new div element
        const newDiv = document.createElement("div");

        // and give it some content
        const newContent = document.createTextNode("Hi there and greetings!");

        // add the text node to the newly created div
        newDiv.appendChild(newContent);

        // add the newly created element and its content into the DOM
        const currentDiv = document.querySelector('.addQuestions');
        document.body.insertBefore(newDiv, currentDiv);
    }

}

let createQuizz = new CreateQuizz() 