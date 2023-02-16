class Admin {
    constructor() {
        this.removeUser = document.querySelector('.removeUser')
        this.removeUser.addEventListener('click', () => { this.removeUserJS() })
    }

    // Call admin controller to remove user from database and ask for confirmation
    removeUserJS() {
        let id = document.querySelector('.removeUser').getAttribute('data-id')
        let name = document.querySelector('.removeUser').getAttribute('data-name')
        // Ask for confirmation
        if (confirm(`Voulez-vous vraiment supprimer l'utilisateur ${name} ?`)) {
            fetch(`admin.php?id=${id}`, {
                method: "DELETE"
            })
                // Get response from controller
                .then(response => response.json())
                .then(data => {
                    // If success, reload page
                    if (data.message == 'success') {
                        alert(`L'utilisateur ${name} a bien été supprimé.`)
                        window.location.reload()
                    } else { // If error, display error message
                        lert(`L'utilisateur ${name} n'a pas pu être supprimé.`)
                    }
                })
        }
    }
}
let admin = new Admin()