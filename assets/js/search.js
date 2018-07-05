function getSearch() {  
    var params = [];

    const category = (document.querySelector('#category')).options[(document.querySelector('#category')).selectedIndex].value;
    params.push(category);
    const brand = (document.querySelector('#brand')).options[(document.querySelector('#brand')).selectedIndex].value;
    params.push(brand);
    const material = document.querySelector('#material').value;
    params.push(material);
    const color = (document.querySelector('#color')).options[(document.querySelector('#color')).selectedIndex].value;
    params.push(color);
    const size = (document.querySelector('#size')).options[(document.querySelector('#size')).selectedIndex].value;
    params.push(size);

    var urlAppend = "";
    params.forEach(param => {
        if (param === "") {
            param = "-";
        }        
        validLinkParam = param.replace(/ /g, '%20');
        urlAppend += validLinkParam + "/";         
    });

    console.log(BASE + 'api/filter/' + urlAppend);
    fetch(BASE + 'api/filter/' + urlAppend, { credentials: 'include' })
        .then(result => result.json())
        .then(data => {            
            displaySearch(data.products);
        });
}

function clearSearch() {
    fetch(BASE + 'api/filter/clear', { credentials: 'include' })
        .then(result => result.json())
        .then(data => {
            if (data.error === 0) {
                getSearch();
            }
        });
}

function displaySearch(products) {
    console.log(products);    
    const productsDiv = document.querySelector('.all-product-div');
    productsDiv.innerHTML = '';

    if (products.length === 0) {
        const insideDiv = document.createElement('div');
        insideDiv.classList.add("text-center", "col-md-12");
        insideDiv.style.color = "#f00";
        insideDiv.style.fontSize = "20px";
        insideDiv.style.padding = "40px 0px 0px 0px";        
        insideDiv.innerHTML = "Nisu pronadjeni proizvodi koji ogovaraju izabranim kriterijumima ili ih nema na stanju.";
        productsDiv.appendChild(insideDiv);
        return;
    }

    for (product of products) {
        const cardDiv = document.createElement('div');
        cardDiv.classList.add("card", "card-product", "bg-transparent", "col-12", "col-sm-12", "col-md-6", "col-lg-3");

        const imgShoe = document.createElement('img');
        imgShoe.classList.add("card-img-top");
        imgShoe.src = BASE + "assets/uploads/" + product.path;
        imgShoe.alt = "Slika - " + product.title;        

        const cardBodyDiv = document.createElement('div');
        cardBodyDiv.classList.add("card-body");

        const imgLogo = document.createElement('img');
        imgLogo.classList.add("logo_small");
        imgLogo.src = BASE + "assets/img/logo/" + product.path_small;
        imgLogo.alt = "Brand logo";
        
        const cardTitle = document.createElement('h5');
        cardTitle.classList.add("card-title");

        const link = document.createElement('a');
        link.classList.add("products-title");
        link.href = BASE + "product/" + product.product_id;
        link.innerHTML = product.title;

        const label = document.createElement('label');
        label.innerHTML = product.price + " din.";

        cardTitle.appendChild(link);

        cardBodyDiv.appendChild(imgLogo);
        cardBodyDiv.appendChild(cardTitle);
        cardBodyDiv.appendChild(label);

        cardDiv.appendChild(imgShoe);
        cardDiv.appendChild(cardBodyDiv);

        productsDiv.appendChild(cardDiv);
    }        
}