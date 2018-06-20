function getSizes() {
    fetch(BASE + 'api/size/', { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            displaySizes(data.size);
        });
}

function addSize() {
    const newSize = document.querySelector('#new_size').value;
    if (newSize < 16 || newSize > 55) {
        document.querySelector('#error-size').innerHTML = 'Velicina biti vrednost izmedju 16 i 55';
        document.querySelector('#error-size').classList.remove('d-none');
        return;
    }
    fetch(BASE + 'api/size/add/' + newSize, { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            if (data.error === 0) {
                getSizes();
            }
        });
}

function displaySizes(size) {
    $('#sizeModal').modal('hide');
    const sizeSelect = document.querySelector('#size');    

    const newOption = document.createElement('option');
    newOption.innerHTML = size[0].value;
    newOption.value = size[0].size_id;
    newOption.selected = "selected";
    sizeSelect.appendChild(newOption);
}
