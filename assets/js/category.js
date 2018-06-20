function getCategorys() {
    fetch(BASE + 'api/category/', { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            displayCategorys(data.category);
        });
}

function addCategory() {
    const newCategory = document.querySelector('#new_category').value;
    fetch(BASE + 'api/category/add/' + newCategory, { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            if (data.error === 0) {
                getCategorys();
            }
        });
}

function displayCategorys(category) {
    const categorySelect = document.querySelector('#category');    

    const newOption = document.createElement('option');
    newOption.innerHTML = category[0].name;
    newOption.value = category[0].category_id;
    newOption.selected = "selected";
    categorySelect.appendChild(newOption);
}
