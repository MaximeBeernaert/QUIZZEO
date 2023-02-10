class Admin {
    constructor() {
        // Get remove user button
        this.removeUser = document.querySelector('.removeUser')
        // Add event listener to remove user button
        this.removeUser.addEventListener('click', () => { this.removeUserJS() })
    }

    // Call admin controller to remove user from database and ask for confirmation
    removeUserJS() {
        // Get user id and name
        let id = document.querySelector('.removeUser').getAttribute('id_utilisateur')
        let nom = document.querySelector('.removeUser').getAttribute('nom_utilisateur')
        let prenom = document.querySelector('.removeUser').getAttribute('prenom_utilisateur')

        // Ask for confirmation
        if (confirm(`Voulez-vous vraiment supprimer l'utilisateur ${nom} ${prenom} ?`)) {
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