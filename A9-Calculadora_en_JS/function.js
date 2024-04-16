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
    if(result == display.val() || display.val() == 'NaN'){ //Vacia el valor para una nueva operacion
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
    operator = op;
    if(op1 == ''){ //Si esta vacio el op1, guardara el valor
        op1 = display.val();
    }else{
        calculate();// Si se sigue haciendo operaciones largas se iran acumulando las operaciones
        op1=result;//Almacenandose en el op1 para seguir con la operacion
    }
    display.val('');//Limpia display
    
}

function calculate() { //Realiza la operacion segun el operador almacenado
    op2 = display.val();//Utiliza el valor del display para realizar la ultima operacion para finalizar
    
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
    op1 = '';

    console.log('calculate..........');
    console.log("op1: "+ op1);
    console.log("op2: "+ op2);
    console.log("op: "+ operator);
    console.log("r: "+ result);
    // console.log("display: "+ display.val());
}