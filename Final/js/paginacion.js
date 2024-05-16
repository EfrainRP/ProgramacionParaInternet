//Esconde todas las paginas y solo muestra la primera pagina
$('.productos').hide();
$('.productos#pagina' + 1).show();
$('.paginacion #pagina' + 1).css("background-color","var(--redPalette-color)");

function mostrarPagina(pagina) {//Esconde todas las paginas y solo muestra la pagina deseada
    $('.productos').hide();
    $('.productos#pagina' + pagina).show();
    $('.paginacion [id^="pagina"]').css("background-color","var(--bluePalette-color)");
    $('.paginacion #pagina' + pagina).css("background-color","var(--redPalette-color)");
}