window.onload = () => {
    document.querySelector('html').style.scrollBehavior = "smooth";
}

function calculateCalorie() {
    let height = parseInt(document.querySelector("#height").value);
    let weight = parseInt(document.querySelector("#weight").value);
    let age = parseInt(document.querySelector("#age").value);

    let alert_div = document.getElementById('info-div');
    var condition = "Error: ";
    var alertType = "alert-secondary";
    var inner_text;
    var extra_text = "";


    let radio_gender = document.querySelectorAll('input[name="gender"]');
    let gender;
    for (let radio of radio_gender) {
        if (radio.checked) {
            gender = parseInt(radio.value);
            console.log(gender);
            break;
        }
    }

    let radio_actlvl = document.querySelectorAll('input[name="actlvl"]');
    let act_lvl;
    for (let radio of radio_actlvl) {
        if (radio.checked) {
            act_lvl = parseFloat(radio.value);
            console.log(act_lvl);
            break;
        }
    }

    if ((age === "" || isNaN(age)) || (age < 15 || age > 80)) {
        inner_text = "Provide an age between 15 to 80!";
    } else if (height === "" || isNaN(height)) {
        inner_text = "Provide a valid height!"
    } else if (weight === "" || isNaN(weight)) {
        inner_text = "Provide a valid weight!";
    } else if (typeof gender == 'undefined') {
        inner_text = "Please provide your age!";
    } else if (typeof act_lvl == 'undefined') {
        inner_text = "Please select an activity level!";
    } else {
        alertType = "alert-success";
        condition = "Success: ";
        inner_text = "Results have been generated!";
        extra_text = `<hr> <p class="mb-0"> Click on the calorie value of your choice to update your preference. </p>`;


        let BMR = ((10 * weight) + (6.25 * height) - (5 * age) + gender) * act_lvl;

        let maintain = document.getElementById('val-0');
        maintain.innerHTML = parseInt(BMR).toLocaleString() + '<small> 100% </sall>';
        maintain.setAttribute("data-cal-value", parseInt(BMR));


        //Weight Loss Values
        let loss_mild = document.getElementById('val-neg1');
        loss_mild.innerHTML = parseInt(BMR * 0.9).toLocaleString() + '<small> 90% </sall>';
        loss_mild.setAttribute("data-cal-value", parseInt(BMR * 0.9));

        let loss = document.getElementById('val-neg2');
        loss.innerHTML = parseInt(BMR * 0.8).toLocaleString() + '<small> 80% </sall>';
        loss.setAttribute("data-cal-value", parseInt(BMR * 0.8));

        let loss_extreme = document.getElementById('val-neg3');
        loss_extreme.innerHTML = parseInt(BMR * 0.6).toLocaleString() + '<small> 60% </sall>';
        loss_extreme.setAttribute("data-cal-value", parseInt(BMR * 0.6));


        //Weight Gain Values
        let gain_mild = document.getElementById('val-pos1');
        gain_mild.innerHTML = parseInt(BMR * 1.1).toLocaleString() + '<small> 110% </sall>';
        gain_mild.setAttribute("data-cal-value", parseInt(BMR * 1.1));

        let gain = document.getElementById('val-pos2');
        gain.innerHTML = parseInt(BMR * 1.2).toLocaleString() + '<small> 120% </sall>';
        gain.setAttribute("data-cal-value", parseInt(BMR * 1.2));

        let gain_extreme = document.getElementById('val-pos3');
        gain_extreme.innerHTML = parseInt(BMR * 1.4).toLocaleString() + '<small> 140% </sall>';
        gain_extreme.setAttribute("data-cal-value", parseInt(BMR * 1.4));


        //Showing hidden div
        let hidden_div = document.getElementById('hidden-calorie-section');
        hidden_div.style.display = "block";
        hidden_div.scrollIntoView(true);
    }

    alert_div.innerHTML = `<div class="alert ` + alertType + `">
                                    <strong>` + condition + `</strong>` + inner_text + extra_text +
                          `</div>`;
}

function getStyle(elem, name) {
    if (document.defaultView && document.defaultView.getComputedStyle) {
        var style = document.defaultView.getComputedStyle(elem, name);
        if (style) {
            return style[name];
        }
    }
    //for Internet Explorer
    else if (elem.currentStyle) {
        return elem.currentStyle[name];
    }

    return null;
}

function showGainInfo() {
    let div = document.getElementById('weight-gain-div');
    let button_gain = document.getElementById('gain-btn');

    if (getStyle(div, "display") == "none") {
        div.style.display = "block";
        button_gain.value = "Hide Weight Gain Info";
        div.scrollIntoView(true);
    } else {
        div.style.display = "none";
        button_gain.value = "Show Weight Gain Info";
    }
}
