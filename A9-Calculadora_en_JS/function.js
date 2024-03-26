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

    console.log("op1: "+ op1);
    console.log("op2: "+ op2);
    console.log("op: "+ operator);
    console.log("r: "+ result);
 
    display.val(display.val() + number);

}

function clearDisplay() {
    display.val('');
    op1 = '';
    op2= '';
    result = '';
    operator = '';
}

function operation(op) {
    op1 = display.val();
    operator = op;
    display.val('');
}

function calculate() {
    op2 = display.val();
    console.log("op1: "+ op1);
    console.log("op2: "+ op2);
    console.log("op: "+ operator);

    switch(operator) {
        case '+':
            result = parseFloat(op1) + parseFloat(op2);
            break;
        case '-':
            result = parseFloat(op1) - parseFloat(op2);
            break;
        case '*':
            result = parseFloat(op1) * parseFloat(op2);
            break;
        case '/':
            if (op2 === '0'){
                result = 'Error';
            }else{
                result = parseFloat(op1) / parseFloat(op2);
            }
            break;
    }
    console.log(result);
    display.val(result);
}