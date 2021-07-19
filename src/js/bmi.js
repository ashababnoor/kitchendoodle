window.onload = () => {
    let button = document.querySelector('#calculateButton');
    let height = parseInt(document.querySelector("#height").value);
    let weight = parseInt(document.querySelector("#weight").value);

    button.addEventListener("click", calculateBMI);
}

function calculateBMI() {
    let height = parseInt(document.querySelector("#height").value);
    let weight = parseInt(document.querySelector("#weight").value);

    var result_text, inner_text;
    var info_text;
    var condition = "Error: ";
    var alertType = "alert-secondary";


    if (height === "" || isNaN(height)) {
        inner_text = "Provide a valid height!"
    } else if (weight === "" || isNaN(weight)) {
        inner_text = "Provide a valid weight!";
    } else {

        //cm squared to meter squared
        let bmi = (weight / ((height * height) / 10000)).toFixed(2);

        let upperBound = ((24.9 * ((height * height) / 10000))).toFixed(2);
        let lowerBound = ((18.5 * ((height * height) / 10000))).toFixed(2);

        info_text = `<div class="alert alert-info">
                        <strong> Suggestion </strong>
                        <br> <br>
                        <p> We suggest you to keep your weight between ` + lowerBound + ` to ` + upperBound + ` kilograms. </p>
                        <hr>
                        <p class="mb-0"> Check out our <a href="calorieCounter.php" class="alert-link"> Calorie Counter </a> to see how you can lose or gain weight. </p>
                    </div>`;

        if (bmi < 18.5) {
            condition = "Underweight: ";
            alertType = "alert-warning";
        } else if (bmi >= 18.5 && bmi < 24.9) {
            condition = "Normal: ";
            alertType = "alert-success";
        } else if (bmi >= 25 && bmi < 29.9) {
            condition = "Overweight: ";
            alertType = "alert-danger"
        } else if (bmi >= 30 && bmi < 34.9) {
            condition = "Obesity - Class I: ";
            alertType = "alert-danger"
        } else if (bmi >= 35 && bmi < 39.9) {
            condition = "Obesity - Class II: ";
            alertType = "alert-danger"
        } else {
            condition = "Morbid Obesity: ";
            alertType = "transparent-red"
        }

        inner_text = `<span>${bmi}</span>`;

        document.getElementById("info-div").innerHTML = info_text;
    }

    result_text = `<div class="alert ` + alertType + `">
                        <strong>` + condition + `</strong>` + inner_text +
        `</div>`;

    document.getElementById("result").innerHTML = result_text;
}