function actualizarCarrito(){
    $.ajax({ //Metodo de js para ejecutar archivos de manera asincrona
        url: './cantidadCarrito.php',
        type:'post', 
        dataType:'text',
        data:'',
        success:function(res){
            console.log('res Carrito '+res);
            $('#carritoMenu span').html(res);
        },error:function(){
            alert('Error archivo no encontrado...');
        }
    });
}