function actualizarCarrito(){
    console.log(" actualizar Carrito");
    $.ajax({ //Metodo de js para ejecutar archivos de manera asincrona
        url: './func/actualizar_cantidadCarrito.php',
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
function eliminaAjax(id,idPedido){
    if(confirm('Seguro que quieres eliminar este producto?')){
        $.ajax({ //Metodo de js para ejecutar archivos de manera asincrona
            url: './func/elimina_pedidos.php',
            type:'post', 
            dataType:'text',
            data:'id='+id+'&id_pedido='+idPedido,
            success:function(res){
                console.log(res);
                if(res != -1){//Se elimina cuando el valor res del evento es 1
                    $('#fila'+id).hide(); //Esconde los elementos con id seleccionado
                    $('#resTotal').html('$'+new Intl.NumberFormat('es-MX').format(res)); //Actualiza el precio total
                    actualizarCarrito(); validarTotal();
                }else{
                    console.log('Error al eliminar');
                }
                },error:function(){
                    alert('Error archivo no encontrado...');
                }
        });
    }
}
function validarCantidad(idPedido,idProducto,stock,costo){
    var cant = $('.cantidadProducto'+idProducto).val();
    $.ajax({ //Metodo de js para ejecutar archivos de manera asincrona
        url: './func/valida_pedido.php',
        type:'post', 
        dataType:'text',
        data:'id_producto='+idProducto+'&id_pedido='+idPedido+'&cantidad='+cant,
        success:function(res){
            console.log(res);
            var arreglo = res.split("_");
            var total = arreglo.at(-1);
            var subtotal = 0;
            if(arreglo[0] == -1){//El valor es < 0
                $('.cantidadProducto'+idProducto).val(1); $("#mensaje").show();
                $('#mensaje').html('Cantidad/es no valido/s');
                setTimeout('$("#mensaje").html(""); $("#mensaje").hide();', 5000);
                subtotal = costo;
                $('#subtotal'+idProducto).html('$'+new Intl.NumberFormat('es-MX').format(subtotal));
            }else if(arreglo[0] == 0){ //El valor es > al stock
                $('.cantidadProducto'+idProducto).val(stock);$("#mensaje").show();
                $('#mensaje').html('Cantidad/es no valido/s');
                setTimeout('$("#mensaje").html(""); $("#mensaje").hide();', 5000);
                subtotal = costo*stock;
                $('#subtotal'+idProducto).html('$'+new Intl.NumberFormat('es-MX').format(subtotal));
            }else if(arreglo[0] == 1){
                subtotal = costo*cant;
            }
            $('#subtotal'+idProducto).html('$'+new Intl.NumberFormat('es-MX').format(subtotal));
            $('#resTotal').html('$'+new Intl.NumberFormat('es-MX').format(total));
        },error:function(){
            alert('Error archivo no encontrado...');
        }
    });
}
function validarTotal(){
    if($('#resTotal').html() == '$0'){ //Si se vacio el carrito, total tiene que ser diferente a $0
        // window.location.href="./carrito1.php";
        $('#continuar').html("Carrito vacio");
        $('#continuar').attr("href","#");
    }
}