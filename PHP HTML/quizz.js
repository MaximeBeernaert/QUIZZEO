
let numberQuestion = 0 

const newDiv = document.createElement("div")
newDiv.className = `newDiv`

const newQuestion = document.createElement('input')
newQuestion.type = 'button'
newQuestion.id = `newQuestion${this.numberQuestion}`
newQuestion.value = `Ajouter une réponse ${this.numberQuestion}`
newQuestion.className = `Button${this.numberQuestion}`
newQuestion.addEventListener('click', () => { this.newQuestion() } )

newDiv.appendChild(newQuestion)

const element1 = document.querySelector('.table')
document.insertBefore(newDiv, element1)