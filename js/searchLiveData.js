// add this inside the <head> tag of html files that need these functions
// <script type="text/javascript" src="js/searchLiveData.js"></script>

function searchfunction(table) {
    var searchString = document.getElementById('inputBox').value;
    var searchStringLen = document.getElementById('inputBox').value.length;

    let icon_div = document.getElementById('icon-div');

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
                        //itemSelected(parameterData);
                    }
                })
            }());
        }
    }
}

function itemSelected(ingredient) {

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
    let a = document.createElement('a');

    let str = "";
    if (table == 'recipes') {
        str = "recipe";
    } else if (table == 'ingredients') {
        str = 'ingredient';
    }
    a.href = str + 'Details.php?id=' + parameterData.id;
    a.textContent = name;
    li.appendChild(a);
    li.id = liId;
    return li;
}