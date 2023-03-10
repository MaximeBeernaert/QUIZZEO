class header {
    constructor() {
        this.houseButton = document.querySelector('.houseButton')
        this.changeHouse()
        this.houseButton.addEventListener('click', () => { this.changeHouse() } )
    }

    changeHouse() {
        let header = document.querySelector('.containerHeader')
        let options = document.querySelector('header')

        let houseButton = document.querySelector('.houseButton')
        let currentHouse = houseButton.className.replace("houseButton ", "")
        switch(currentHouse) {
            case 'Griffondor':
                options.style.backgroundColor = "#1c1c1c";
                houseButton.className = "houseButton Poufsouffle"
                header.style.backgroundImage = "url('poufsouffle.png')";
                this.createCookie(`currentHouse`,`houseButton Griffondor`,"1")
                break;
            case 'Poufsouffle':
                options.style.backgroundColor = "#000814";
                houseButton.className = "houseButton Serdaigle"
                header.style.backgroundImage = "url('serdaigle.png')";
                this.createCookie(`currentHouse`,`houseButton Poufsouffle`,"1")
                break;
            case 'Serdaigle':
                options.style.backgroundColor = "#134611";
                houseButton.className = "houseButton Serpentard"
                header.style.backgroundImage = "url('serpentard.png')";
                this.createCookie(`currentHouse`,`houseButton Serdaigle`,"1")
                break;
            case 'Serpentard':
                options.style.backgroundColor = "#220901";
                houseButton.className = "houseButton Griffondor"
                header.style.backgroundImage = "url('griffondor.png')";
                this.createCookie(`currentHouse`,`houseButton Serpentard`,"1")
                break;
        }
        
    }

    createCookie(name, value, days) {
        var expires;
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        else {
            expires = "";
        }
        document.cookie = escape(name) + "=" + 
            escape(value) + expires + "; path=/";
    }
}
$header = new header()