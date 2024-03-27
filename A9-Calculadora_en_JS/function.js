// var botones = document.querySelectorAll(".number");

// // Adjuntar el evento de clic al botón utilizando addEventListener()
// // boton.addEventListener('click', function(){
// //     console.log('¡Haz hecho clic en el botón!');
// // });
// botones.forEach((boton) => {
//     boton.addEventListener("click",()=>{
//     console.log(boton.value);
//     document.getElementById('display').value += boton.value;
//     });
// });

// Memoria de la calculadora
let op1 = '';
let op2= '';
let result = '';
let operator = '';

let display = $('#display'); //Variable para usar jQuery y obtener su valor

function numberClicked(number) {//Funcion para escribir en el display
    if(result == display.val()){ //Vacia el valor para una nueva operacion
        display.val('');
    }else if((number == '.') && (display.val().includes('.'))){ //Evita poner varios puntos en el numero
        return;
    }
    
    display.val(display.val() + number); //Se concatena los numeros
}

function clearDisplay(text) { //Funcion para limpiar la calculadora
    if(text=='AC'){//Limpia toda la memoria y display
        display.val('');
        op1 = '';
        op2= '';
        result = '';
        operator = '';
    }else{ //Limpia el display
        display.val('');
    }
}

function operation(op) { //Funcion para seguir con el siguiente numero si se presiono el operador
    op1 = display.val();
    operator = op;
    display.val('');
}

function calculate() { //Realiza la operacion segun el operador almacenado
    op2 = display.val();
    switch(operator) {
        case '+':
            result = parseFloat(op1) + parseFloat(op2);
            break;
        case '-':
            result = parseFloat(op1) - parseFloat(op2);
            result = result.toFixed(4); //Se redondea, debido a un error de calculo por los flotantes en js
            break;
        case '*':
            result = parseFloat(op1) * parseFloat(op2);
            break;
        case '/':
            if (op2 == '0'){//Si se divide entre 0, se evita el error
                result = 'Error';
            }else{
                result = parseFloat(op1) / parseFloat(op2);
            }
            break;
        default: //Si hubo algun error, se mandara el mensaje de Error
            result = "Error"
            break;
    }
    display.val(result.toString()); //Pasamos el resultado al display

    console.log("op1: "+ op1);
    console.log("op2: "+ op2);
    console.log("op: "+ operator);
    console.log("r: "+ result);
    // console.log("display: "+ display.val());
}