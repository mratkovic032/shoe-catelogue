function getBrands() {
    fetch(BASE + 'api/brand/', { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            displayBrands(data.brand);
        });
}

function addBrand() {
    const newBrand = document.querySelector('#new_brand').value;
    fetch(BASE + 'api/brand/add/' + newBrand, { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            if (data.error === 0) {
                getBrands();
            }
        });
}

function displayBrands(brand) {
    const brandSelect = document.querySelector('#brand');    

    const newOption = document.createElement('option');
    newOption.innerHTML = brand[0].name;
    newOption.value = brand[0].brand_id;
    newOption.selected = "selected";
    brandSelect.appendChild(newOption);
}
