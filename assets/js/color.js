function getColors() {
    fetch(BASE + 'api/color/', { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            displayColors(data.color);
        });
}

function addColor() {
    const newColor = document.querySelector('#new_color').value;
    fetch(BASE + 'api/color/add/' + newColor, { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            if (data.error === 0) {
                getColors();
            }
        });
}

function displayColors(color) {
    const colorSelect = document.querySelector('#color');    

    const newOption = document.createElement('option');
    newOption.innerHTML = color[0].name;
    newOption.value = color[0].color_id;
    newOption.selected = "selected";
    colorSelect.appendChild(newOption);
}
