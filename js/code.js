// add this inside the <head> tag of html file
// <script type="text/javascript" src="js/code.js"></script>

function redirect(url) {
    location.assign(url);
}

function search(text, table) {
    if (table == 'recipes') {
        location.assign('recipeSearchResult.php?text=' + text);
    } else if (table == 'ingredients') {
        location.assign('ingredientSearchResult.php?text=' + text);
    }

}

function deletefn(id, table) {
    var result = confirm("Are you sure you want to delete?");
    if (result) {
        location.assign('deleteProcess.php?id=' + id + '&table=' + table);
    }
}

function deletefn_recipeIngredient(recipeId, ingredientId) {
    var result = confirm("Are you sure you want to delete this ingredient from this recipe?");
    if (result) {
        location.assign('recipeIngredientDeleteProcess.php?recipeId=' + recipeId + '&ingredientId=' + ingredientId);
    }
}

function deletefn_ingredientAttribute(ingredientId, attrId) {
    var result = confirm("Are you sure you want to delete this attribute from this ingredient?");
    if (result) {
        location.assign('ingredientAttributeDeleteProcess.php?ingredientId=' + ingredientId + '&attrId=' + attrId);
    }
}

function deletefn_diseaseFoods(diseaseId, foodId){
    var result = confirm("Are you sure you want to delete this food from this disease's restricted list?");
    if (result) {
        location.assign('diseaseFoodDeleteProcess.php?diseaseId=' + diseaseId + '&foodId=' + foodId);
    }
}

function showHiddenSection() {
    var x = document.getElementById('hidden-section');
    if (x.style.display == "block") {
        x.style.display = 'none';
    } else {
        x.style.display = "block";
    }
}

function addIngredientToRecipe(recipeId) {
    location.assign('recipeIngredients.php?recipeId=' + recipeId);
}