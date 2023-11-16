//hard coded class, uses variable 'annonces' from bd to show and filter current annonces
class AnnoncesViewer {

    constructor(){

        //html references
        this.annoncesContainer = document.getElementById('ac1')
        this.filtresBtn = document.getElementById('filtres-btn')
        this.filtresEraseBtn = document.getElementById('filtres-erase-btn')
        this.inputPriceMin = document.getElementById('ipmin')
        this.inputPriceMax = document.getElementById('ipmax')
        this.inputKmMin = document.getElementById('ikmin')
        this.inputKmMax = document.getElementById('ikmax')
        this.inputYearMin = document.getElementById('iymin')
        this.inputYearMax = document.getElementById('iymax')
        this.inputSortPriceUp = document.getElementById('priceUp')
        this.inputSortPriceDown = document.getElementById('priceDown')
        this.inputSortMileageUp = document.getElementById('mileageUp')
        this.inputSortMileageDown = document.getElementById('mileageDown')
        this.inputSortYearUp = document.getElementById('yearUp')
        this.inputSortYearDown = document.getElementById('yearDown')

        //array of objects with announce info, last added = first shown.
        this.annoncesList = annonces.reverse()
        //array of annonces to be shown
        this.filteredList = []

        //sort params
        this.sortParam = 'price';
        this.sortOrder = true;

        //render all announces at script init
        this.drawBlocks(this.annoncesList)

        //push announces objects into filtered array based on filters, sort them based on input fileds, and render them
        this.filtresBtn.addEventListener('click',()=>{
            this.filteredList = [];
            this.annoncesList.forEach(annonce => {
                if (
                    (this.inputPriceMin.value === '' || annonce.price >= this.inputPriceMin.value) &&
                    (this.inputPriceMax.value === '' || annonce.price <= this.inputPriceMax.value) &&
                    (this.inputKmMin.value === '' || annonce.mileage >= this.inputKmMin.value) &&
                    (this.inputKmMax.value === '' || annonce.mileage <= this.inputKmMax.value) &&
                    (this.inputYearMin.value === '' || annonce.year >= this.inputYearMin.value) &&
                    (this.inputYearMax.value === '' || annonce.year <= this.inputYearMax.value)
                ) {
                    this.filteredList.push(annonce);
                }
            });
            //get sort param and order param based on input user
            this.updateSortParams()
            //sort by param given results
            this.filteredList = this.sortObjectsByNumber(this.filteredList, this.sortParam , this.sortOrder);
            this.drawBlocks(this.filteredList)
        })

        //erase filters values and render all annonces
        this.filtresEraseBtn.addEventListener('click',()=>{
            this.drawBlocks(this.annoncesList)
            this.inputPriceMin.value = ''
            this.inputPriceMax.value = ''
            this.inputKmMin.value = ''
            this.inputKmMax.value = ''
            this.inputYearMin.value = ''
            this.inputYearMax.value = ''
        })
    }

    //updates sortParam and sortOrder based on input values
    updateSortParams(){

        if(this.inputSortPriceUp.checked){
            this.sortParam = 'price';
            this.sortOrder = true;
        }
        if(this.inputSortPriceDown.checked){
            this.sortParam = 'price';
            this.sortOrder = false;
        }
        if(this.inputSortMileageUp.checked){
            this.sortParam = 'mileage';
            this.sortOrder = true;
        }
        if(this.inputSortMileageDown.checked){
            this.sortParam = 'mileage';
            this.sortOrder = false;
        }
        if(this.inputSortYearUp.checked){
            this.sortParam = 'year';
            this.sortOrder = true;
        }
        if(this.inputSortYearDown.checked){
            this.sortParam = 'year';
            this.sortOrder = false;
        }

    }

    //sort given array by given param
    sortObjectsByNumber(arr, param, ascending = true) {
        if (ascending) {
          return arr.slice().sort((a, b) => a[param] - b[param]);
        } else {
          return arr.slice().sort((a, b) => b[param] - a[param]);
        }
      }
    
    //erase all rendered announces until now
    eraseBlocks(){
        this.annoncesContainer.innerHTML = ''
    }

    //render annonce specified in param
    createBlock(annonce){
        this.annoncesContainer.innerHTML += 
        `
        <a href='./annoncement${annonce.id}'>
            <div id ='${annonce.id}' class='annonce-block'>
                <div class='annonce-img-container'>
                    <img src='${annonce.imgPath1}' class='annonces-img'>
                </div>
                <div class='annonce-info'>
                    <p class='f-3'>${annonce.brand} ${annonce.model}</p>
                    <p class='f-2'>${annonce.price} €</p>
                    <table>
                            <th class='f-2'><img src='sources/img/year_icon.png' class='annonce-card-info-description-img'>${annonce.year}</th>
                            <th class='f-2'><img src='sources/img/mileage_icon.png' class='annonce-card-info-description-img'>${annonce.mileage}</th>
                            <th class='f-2'><img src='sources/img/gas_icon.png' class='annonce-card-info-description-img'>${annonce.fuel_type}</th>
                            <th class='f-2'><img src='sources/img/transmission_icon.png' class='annonce-card-info-description-img'>${annonce.transmission}</th>
                    </table>
                </div>
            </div>
        <a>
        `
    }

    //render announces from given liste
    drawBlocks(list){
        this.eraseBlocks()
        list.forEach(annonce => {
            this.createBlock(annonce)
        });
    }

}

let aw1 = new AnnoncesViewer

