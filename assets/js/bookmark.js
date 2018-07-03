function getBookmarks() {
    fetch(BASE + 'api/bookmarks/', { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            displayBookmarks(data.bookmarks);
        });
}

function addBookmark(productId) {
    $('#success-wishlist').addClass("show");    
    $('#wishlist').addClass("swing");

    fetch(BASE + 'api/bookmarks/add/' + productId, { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            if (data.error === 0) {
                getBookmarks();
            }
        });
}

function clearBookmarks() {
    fetch(BASE + 'api/bookmarks/clear', { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            if (data.error === 0) {
                getBookmarks();
            }
        });
}

function displayBookmarks(bookmarks) {
    const bookmarksDiv = document.querySelector('.bookmarks');
    bookmarksDiv.innerHTML = '';

    if (bookmarks.length === 0) {
        bookmarksDiv.innerHTML = "Vasa lista zelja je prazna.";
        return;
    }

    for (bookmark of bookmarks) {
        const bookmarkLink = document.createElement('a');
        bookmarkLink.classList.add("dropdown-item");
        bookmarkLink.style.display = 'block';
        bookmarkLink.innerHTML = bookmark.title;
        bookmarkLink.href = BASE + "product/" + bookmark.product_id;
        bookmarksDiv.appendChild(bookmarkLink);
    }        
}

addEventListener('load', getBookmarks);