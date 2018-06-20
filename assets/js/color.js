function getColors() {
    fetch(BASE + 'api/color/', { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            displayColors(data.color);
        });
}

function addColor() {
    const newColor = document.querySelector('#new_color').value;
    if (!newColor.match(/^[A-Z][a-z]{2,}/)) {
        document.querySelector('#error-color').innerHTML = 'Naziv boje mora da pocne velikim slovom i da sadrzi minimalno tri karaktera';
        document.querySelector('#error-color').classList.remove('d-none');
        return;
    }   
    fetch(BASE + 'api/color/add/' + newColor, { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            if (data.error === 0) {
                getColors();
            }
        });
}

function displayColors(color) {
    $('#colorModal').modal('hide');
    const colorSelect = document.querySelector('#color');    

    const newOption = document.createElement('option');
    newOption.innerHTML = color[0].name;
    newOption.value = color[0].color_id;
    newOption.selected = "selected";
    colorSelect.appendChild(newOption);
}
