class Slider {

    sliderViewPort
    band 
    cardExemple 

    bandStyles
    bandWidth
    cardWidth

    bandCord = 0;

    maxLeft
    maxRight
    
    shownOnMobile = 1
    shownOnDesktop = 3
    desktopTreshold = 700

    constructor(sliderViewPortId,sliderBandId,cardClass){
        
        this.sliderViewPort = document.getElementById(sliderViewPortId);
        this.band = document.getElementById(sliderBandId);
        this.cardExemple = document.querySelector(cardClass);
        this.bandStyles = getComputedStyle(this.band);
        this.bandWidth = parseInt(getComputedStyle(this.band).width)
        this.cardWidth = parseInt(getComputedStyle(this.cardExemple).width) + parseInt(getComputedStyle(this.cardExemple).margin)*2 + parseInt(getComputedStyle(this.cardExemple).borderWidth)*2

        this.sliderViewPort.style.width =  window.innerWidth > 1400? this.cardWidth*this.shownOnDesktop + 'px' : this.cardWidth*this.shownOnMobile + 'px'

        this.maxLeft = window.innerWidth > this.desktopTreshold? -this.bandWidth + this.cardWidth*this.shownOnDesktop-1 : -this.bandWidth
        this.maxRight = -this.cardWidth;

        addEventListener('resize',(e)=>{ //listen for window width change
            if(window.innerWidth > this.desktopTreshold){ //desktop version
                this.bandWidth = parseInt(getComputedStyle(this.band).width)
                this.bandCord = 0;
                this.band.style.transform = 'translate('+ this.bandCord +'px)'
                this.cardWidth = parseInt(getComputedStyle(this.cardExemple).width) + parseInt(getComputedStyle(this.cardExemple).margin)*2 + parseInt(getComputedStyle(this.cardExemple).borderWidth)*2
                this.sliderViewPort.style.width = this.cardWidth*this.shownOnDesktop + 'px';
                this.maxLeft = -this.bandWidth + this.cardWidth*this.shownOnDesktop-1
                this.maxRight = -this.cardWidth;
            } else { //mobile version
                this.bandWidth = parseInt(getComputedStyle(this.band).width)
                this.bandCord = 0;
                this.band.style.transform = 'translate('+ this.bandCord +'px)'
                this.cardWidth = parseInt(getComputedStyle(this.cardExemple).width) + parseInt(getComputedStyle(this.cardExemple).margin)*2 + parseInt(getComputedStyle(this.cardExemple).borderWidth)*2
                this.sliderViewPort.style.width = this.cardWidth*this.shownOnMobile + 'px';
                this.maxLeft = -this.bandWidth + this.cardWidth*this.shownOnMobile-1
                this.maxRight = -this.cardWidth;
            }
        });
    }
    
    sliderRight(){
        // console.clear()
        // console.log('moving from ->' + this.bandCord)
        if(this.bandCord - this.cardWidth >= this.maxLeft){
            this.bandCord = this.bandCord - this.cardWidth
            this.band.style.transform = 'translate('+ this.bandCord +'px)'
        } else {
            this.bandCord = 0;
            this.band.style.transform = 'translate('+ this.bandCord +'px)'
        }
        // console.log('To ->' + this.bandCord)
        // console.log('LIMIT SET TO ' + this.maxLeft)
        // console.log('CARD WIDTH IS ' + this.cardWidth)
    }
    
    sliderLeft(){
        // console.clear()
        // console.log('moving from ->' + this.bandCord)
        if(this.bandCord - this.cardWidth < this.maxRight){
            this.bandCord = this.bandCord + this.cardWidth
            this.band.style.transform = 'translate('+ this.bandCord +'px)'
            console.log(this.bandCord +' - '+ this.cardWidth +' < '+ this.maxRight)
        } 
        // console.log('To ->' + this.bandCord)
        // console.log('LIMIT SET TO ' + this.maxLeft)
        // console.log('CARD WIDTH IS ' + this.cardWidth)
    }

    setShownOnMobile(number){
        this.shownOnMobile = number
        this.sliderViewPort.style.width =  window.innerWidth > this.desktopTreshold? this.cardWidth*this.shownOnDesktop + 'px' : this.cardWidth*this.shownOnMobile + 'px'
        this.maxLeft = window.innerWidth > this.desktopTreshold? -this.bandWidth + this.cardWidth*this.shownOnDesktop-1 : -this.bandWidth + this.cardWidth*this.shownOnMobile-1
    }

    setShownOnDesctop(number){
        this.shownOnDesktop = number
        this.sliderViewPort.style.width =  window.innerWidth > this.desktopTreshold? this.cardWidth*this.shownOnDesktop + 'px' : this.cardWidth*this.shownOnMobile + 'px'
        this.maxLeft = window.innerWidth > this.desktopTreshold? -this.bandWidth + this.cardWidth*this.shownOnDesktop-1 : -this.bandWidth + this.cardWidth*this.shownOnMobile-1
    }
}


