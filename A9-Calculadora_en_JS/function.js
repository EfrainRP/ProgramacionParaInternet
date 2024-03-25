var botones = document.querySelectorAll("input[type=\"button\"]");

// Adjuntar el evento de clic al botón utilizando addEventListener()
// boton.addEventListener('click', function(){
//     console.log('¡Haz hecho clic en el botón!');
// });
botones.forEach((boton) => {
    boton.addEventListener("click",function(){
        console.log(boton.value);
        document.getElementById('display').value += boton.value;
    });
});