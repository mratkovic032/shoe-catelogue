function validateProduct() {
    let status = true;

    document.querySelector('#error-title').classList.add('d-none');
    document.querySelector('#error-title').innerHTML = '';
    document.querySelector('#error-description').classList.add('d-none');
    document.querySelector('#error-description').innerHTML = '';
    document.querySelector('#error-material').classList.add('d-none');
    document.querySelector('#error-material').innerHTML = '';

    const title = document.querySelector('#title').value;
    if (!title.match(/^[A-Z][a-z]{2,}/)) {
        document.querySelector('#error-title').innerHTML = 'Naziv modela mora da pocinje velikim slovom i da sadrzi minimalno tri karaktera';
        document.querySelector('#error-title').classList.remove('d-none');
        status = false;
    }

    const description = document.querySelector('#description').value;
    if (!description.match(/.*[^\s]{7,}.*/)) {
        document.querySelector('#error-description').innerHTML = 'Opis mora sadrzati minimalno sedam karaktera';
        document.querySelector('#error-description').classList.remove('d-none');
        status = false;
    }

    const material = document.querySelector('#material').value;
    if (!material.match(/^[A-Z][a-z]{2,}/)) {
        document.querySelector('#error-material').innerHTML = 'Naziv materijala mora da pocinje velikim slovom i da sadrzi minimalno tri karaktera';
        document.querySelector('#error-material').classList.remove('d-none');
        status = false;
    }

    return status;
}