function getBrands() {
    fetch(BASE + 'api/brand/', { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            displayBrands(data.brand);
        });
}

function addBrand() {
    const newBrand = document.querySelector('#new_brand').value;
    if (!newBrand.match(/^[A-Z][a-z]{2,}/)) {
        console.log("nije dobar match");
        document.querySelector('#error-brand').innerHTML = 'Naziv brenda mora da pocne velikim slovom i da sadrzi minimalno tri karaktera';
        document.querySelector('#error-brand').classList.remove('d-none');
        return;
    } 
    fetch(BASE + 'api/brand/add/' + newBrand, { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            if (data.error === 0) {
                getBrands();
            }
        });
}

function displayBrands(brand) {
    $('#brandModal').modal('hide');
    const brandSelect = document.querySelector('#brand');    

    const newOption = document.createElement('option');
    newOption.innerHTML = brand[0].name;
    newOption.value = brand[0].brand_id;
    newOption.selected = "selected";
    brandSelect.appendChild(newOption);
}
