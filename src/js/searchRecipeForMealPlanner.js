// add this inside the <head> tag of html files that need these functions
// <script type="text/javascript" src="js/searchRecipeForMealPlanner.js"></script>

function searchfunction(table) {
    var searchString = document.getElementById('inputBox').value;
    var searchStringLen = document.getElementById('inputBox').value.length;

    let icon_div = document.getElementById('icon-div');

    let recipeId = document.getElementById('recipeId');
    recipeId.value = "";
    let price = document.getElementById('recipe-price');
    price.value = 0;

    if (searchString != null && searchStringLen > 2) {
        icon_div.style.borderBottom = "1px solid #ccc";

        var ourRequest = new XMLHttpRequest();
        ourRequest.open('GET', 'getDataBySearchCustomer.php?str=' + searchString + '&table=' + table);

        ourRequest.onload = function() {


            if (ourRequest.status >= 200 && ourRequest.status < 400) {
                var ourData = JSON.parse(ourRequest.responseText);

                renderHTML(ourData, table);

            } else {
                alert("We connected to the server but it returned an error!");
            }
        };

        ourRequest.onerror = function() {
            alert("Connection Error!");
        };
        ourRequest.send();
    } else {
        icon_div.style.borderBottom = "none";

        let list = document.getElementById('search-results');
        removeAllChild(list);
    }
}

function renderHTML(data, table) {
    let list = document.getElementById('search-results');

    removeAllChild(list);

    if (data.length == 0 || data == null) {
        let li = document.createElement('li');
        li.classList.add('search-item');
        li.style.color = "#d9534f";
        li.textContent = "No results found.";

        list.appendChild(li);
    } else {
        for (i = 0; i < data.length; i++) {
            (function() {
                let parameterData = data[i];
                let liId = "" + i;
                let li = createListItem(data[i].name, liId, parameterData, table);

                list.appendChild(li);

                list.addEventListener('click', function(e) {
                    if (e.target && e.target.nodeName == 'LI' && e.target.id == liId) {
                        itemSelected(parameterData);
                    }
                })
            }());
        }
    }
}

function blurfunction() {
    let icon_div = document.getElementById('icon-div');
    icon_div.style.borderBottom = "none";

    let list = document.getElementById('search-results');
    removeAllChild(list);
}

function itemSelected(recipe) {
    let recipeId = document.getElementById('recipeId');
    recipeId.value = recipe.id;
    let price = document.getElementById('recipe-price');
    price.value = recipe.total_price;
    console.log("Price from search: " + price.value);

    var searchbox = document.getElementById('inputBox');
    searchbox.value = recipe.name;
    blurfunction();
}

function removeAllChild(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}

function createListItem(name, liId, parameterData, table) {
    let li = document.createElement('li');
    li.classList.add("search-item");
    li.style.cursor = "pointer";
    li.textContent = name;
    li.id = liId;
    return li;
}