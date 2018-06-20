function getCategories() {
    fetch(BASE + 'api/category/', { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            displayCategorys(data.category);
        });
}

function addCategory() {
    const newCategory = document.querySelector('#new_category').value;
    if (!newCategory.match(/^[A-Z][a-z]{2,}/)) {
        document.querySelector('#error-category').innerHTML = 'Naziv kategorije mora da pocne velikim slovom i da sadrzi minimalno tri karaktera';
        document.querySelector('#error-category').classList.remove('d-none');
        return;
    } 
    fetch(BASE + 'api/category/add/' + newCategory, { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            if (data.error === 0) {
                getCategories();
            }
        });
}

function displayCategorys(category) {
    $('#categoryModal').modal('hide');
    const categorySelect = document.querySelector('#category');    

    const newOption = document.createElement('option');
    newOption.innerHTML = category[0].name;
    newOption.value = category[0].category_id;
    newOption.selected = "selected";
    categorySelect.appendChild(newOption);
}
