// add this inside the <head> tag of html files that need these functions
// <script type="text/javascript" src="js/searchIngredientForRecipe.js"></script>


function searchfunction() {
    var searchString = document.getElementById('search-box').value;
    var searchStringLen = document.getElementById('search-box').value.length;

    let table = 'ingredients';
    let search_input_div = document.getElementById('search-input-div');

    if (searchString != null && searchStringLen != 0) {
        search_input_div.style.borderBottom = "1px solid #ccc";

        var ourRequest = new XMLHttpRequest();
        ourRequest.open('GET', 'getDataBySearch.php?str=' + searchString + '&table=' + table);

        ourRequest.onload = function() {
            if (ourRequest.status >= 200 && ourRequest.status < 400) {
                var ourData = JSON.parse(ourRequest.responseText);

                renderHTML(ourData);
            } else {
                alert("We connected to the server but it returned an error!");
            }
        };

        ourRequest.onerror = function() {
            alert("Connection Error!");
        };
        ourRequest.send();
    } else {
        search_input_div.style.borderBottom = "none";

        let list = document.getElementById('search-list');
        removeAllChild(list);
    }
}

function blurfunction() {
    let search_input_div = document.getElementById('search-input-div');
    search_input_div.style.borderBottom = "none";

    let list = document.getElementById('search-list');
    removeAllChild(list);
}

function renderHTML(data) {
    console.log(data);
    let list = document.getElementById('search-list');

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
                let li = createListItem(data[i].name, liId);

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

function itemSelected(ingredient) {
    let ingredientName = document.getElementById('ingredientName');
    let ingredientId = document.getElementById('ingredientId');
    let unit = document.getElementById('unit');
    let unit_hidden = document.getElementById('unit-hidden');

    ingredientId.value = ingredient.id;
    ingredientName.value = ingredient.name;
    unit.value = ingredient.measurement_unit;
    unit_hidden.value = ingredient.measurement_unit;

    var searchbox = document.getElementById('search-box');
    searchbox.value = ingredient.name;
    blurfunction();
}

function removeAllChild(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}

function createListItem(name, liId) {
    let li = document.createElement('li');
    li.classList.add("search-item");
    li.style.cursor = "pointer";
    li.textContent = name;
    li.id = liId;
    return li;
}