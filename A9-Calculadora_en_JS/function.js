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

let op1 = '';
let op2= '';
let result = '';
let operator = '';

let display = $('#display');

function numberClicked(number) {
    if(result == display.val()){
        display.val('');
    }
        display.val(display.val() + number);
        // console.log("op1: "+ op1);
        // console.log("op2: "+ op2);
        // console.log("op: "+ operator);
        // console.log("r: "+ result);
        // console.log("display: "+ display.val());

}

function clearDisplay(text) {
    if(text=='AC'){
        display.val('');
        op1 = '';
        op2= '';
        result = '';
        operator = '';
    }else{
        display.val('');
    }
}

function operation(op) {
    op1 = display.val();
    operator = op;
    display.val('');
}

function calculate() {
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
            if (op2 == '0'){
                result = 'Error';
            }else{
                result = parseFloat(op1) / parseFloat(op2);
            }
            break;
        default:
            result = "Error"
            break;
    }
    operator = ''; //Limpiamos el operador para futuras operaciones
    display.val(result.toString());
    console.log("op1: "+ op1);
    console.log("op2: "+ op2);
    // console.log("op: "+ operator);
    console.log("r: "+ result);
    // console.log("display: "+ display.val());

}