/* =====================================
   CONVERTER NAVIGATION
===================================== */

function goToConverter(){

    let converter = document.getElementById("converterMenu").value;


    if(converter !== ""){

        window.location.href = "converters/" + converter + ".html";

    }

}



/* =====================================
   GENERAL CONVERSION FUNCTION
===================================== */

function convert(){


    let input = document.getElementById("inputValue");
    let type = document.getElementById("type");
    let resultBox = document.getElementById("result");


    // Check elements exist

    if(!input || !type || !resultBox){

        console.error("Converter elements missing");

        return;

    }



    let value = parseFloat(input.value);


    // Validate input

    if(isNaN(value)){


        resultBox.innerHTML =
        "Please enter a valid number";


        return;

    }



    let conversion = type.value;

    let result;



    switch(conversion){



/* =====================================
        LENGTH CONVERSION
===================================== */


        case "meter-kilometer":

            result = value / 1000;

            break;



        case "kilometer-meter":

            result = value * 1000;

            break;



        case "meter-centimeter":

            result = value * 100;

            break;



        case "centimeter-meter":

            result = value / 100;

            break;



        case "meter-mile":

            result = value / 1609.34;

            break;



        case "mile-meter":

            result = value * 1609.34;

            break;




/* =====================================
        AREA CONVERSION
===================================== */


        case "sqm-sqkm":

            result = value / 1000000;

            break;



        case "sqkm-sqm":

            result = value * 1000000;

            break;



        case "sqm-sqft":

            result = value * 10.7639;

            break;



        case "sqft-sqm":

            result = value / 10.7639;

            break;





/* =====================================
        WEIGHT CONVERSION
===================================== */


        case "kg-gram":

            result = value * 1000;

            break;



        case "gram-kg":

            result = value / 1000;

            break;



        case "kg-pound":

            result = value * 2.20462;

            break;



        case "pound-kg":

            result = value / 2.20462;

            break;



        case "kg-ton":

            result = value / 1000;

            break;



        case "ton-kg":

            result = value * 1000;

            break;





/* =====================================
        VOLUME CONVERSION
===================================== */


        case "liter-ml":

            result = value * 1000;

            break;



        case "ml-liter":

            result = value / 1000;

            break;



        case "liter-gallon":

            result = value / 3.78541;

            break;



        case "gallon-liter":

            result = value * 3.78541;

            break;





/* =====================================
        TEMPERATURE CONVERSION
===================================== */


        case "c-f":

            result = (value * 9/5) + 32;

            break;



        case "f-c":

            result = (value - 32) * 5/9;

            break;



        case "c-k":

            result = value + 273.15;

            break;



        case "k-c":

            result = value - 273.15;

            break;





/* =====================================
        SPEED CONVERSION
===================================== */


        case "kmh-ms":

            result = value / 3.6;

            break;



        case "ms-kmh":

            result = value * 3.6;

            break;



        case "mph-kmh":

            result = value * 1.60934;

            break;



        case "kmh-mph":

            result = value / 1.60934;

            break;





/* =====================================
        TIME CONVERSION
===================================== */


        case "hour-minute":

            result = value * 60;

            break;



        case "minute-hour":

            result = value / 60;

            break;



        case "minute-second":

            result = value * 60;

            break;



        case "second-minute":

            result = value / 60;

            break;



        case "day-hour":

            result = value * 24;

            break;



        case "hour-day":

            result = value / 24;

            break;




        default:


            result = null;


    }



    // Display result


    if(result === null || isNaN(result)){


        resultBox.innerHTML =
        "Conversion not available";


    }

    else{


        resultBox.innerHTML =
        "Result: " + Number(result).toFixed(3);


    }


}