class header {
    constructor() {
        this.houseButton = document.querySelector('.houseButton')
        this.changeHouse()
        this.houseButton.addEventListener('click', () => { this.changeHouse() } )
    }

    changeHouse() {
        let houseButton = document.querySelector('.houseButton')
        let currentHouse = houseButton.className.replace("houseButton ", "")
        switch(currentHouse) {
            case 'Griffondor':
                this.changeColor("#000814","#003566","SerdaigleIcone.png","houseButton Serdaigle","url('serdaigle.png')","#FFD60A","#FFFFE0","#001D3D")
                this.createCookie(`currentHouse`,`houseButton Griffondor`,"1")
                break;
            case 'Poufsouffle':
                this.changeColor("#220901","#941B0C","GriffondorIcone.png","houseButton Griffondor","url('griffondor.png')","#F6AA1C","#FEC3AC","#621708");
                this.createCookie(`currentHouse`,`houseButton Poufsouffle`,"1")
                break;
            case 'Serdaigle':
                
                this.changeColor("#134611","#3E8914","SerpentardIcone.png","houseButton Serpentard","url('serpentard.png')","#96E072","#E8FCCF","#3DA35D")
                this.createCookie(`currentHouse`,`houseButton Serdaigle`,"1")
                break;
            case 'Serpentard':
                this.changeColor("#1c1c1c","#FDCA00","PoufsouffleIcone.png","houseButton Poufsouffle","url('Poufsouffle.png')","#FEE402","#FAFAD2","#111111")
                
                this.createCookie(`currentHouse`,`houseButton Serpentard`,"1")
                break;
        }
        
    }

    changeColor(color1,color2,icone,buttonname,imagebg,color5,color7,color9) {
        let header = document.querySelector('.containerHeader')
        let options = document.querySelector('header')
        let bannerColor = document.querySelectorAll('.banner')
        let bannerIcone = document.querySelectorAll('.houseIcone')
        let houseButton = document.querySelector('.houseButton')
        let quizzs = document.querySelectorAll('.quizz')
        let quizzbuttons = document.querySelectorAll('.quizzButton')
        let footer = document.querySelector('.footer')
        let thead = document.querySelector('thead')
        let titleRed = document.querySelector('.titleRed')

        let color3 = color1 
        let color4 = color2
        let color6 = color5
        let color8 = color7
        let color10 = color9
        let icone1 = icone
        let buttonname1 = buttonname
        let imagebg1 = imagebg

        options.style.backgroundColor = color3
        bannerColor.forEach(banner => {
            banner.style.backgroundColor = color4;
        })
        bannerIcone.forEach(banner => {
            banner.src = icone1
        })
        houseButton.className = buttonname1
        houseButton.src = icone1
        header.style.backgroundImage = imagebg1;
        quizzs.forEach(quizzs => {
            quizzs.style.borderColor = color6
            quizzs.style.backgroundColor = color8;
        })
        quizzbuttons.forEach(quizzbutton => {
            quizzbutton.style.backgroundColor = color10;
        })
        footer.style.backgroundColor = color3;
        if(document.querySelector('thead')){
            thead.style.backgroundColor = color10;
        }
        if((titleRed) != null){
            titleRed.style.backgroundColor = color4;
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