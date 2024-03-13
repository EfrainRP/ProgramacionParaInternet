<?php
    function getMes($valor){
        switch($valor){
            case 1: $mes_text = 'Enero'; break;
            case 2: $mes_text = 'Febrero'; break;
            case 3: $mes_text = 'Marzo'; break;
            case 4: $mes_text = 'Abril'; break;
            case 5: $mes_text = 'Mayo'; break;
            case 6: $mes_text = 'Junio'; break;
            case 7: $mes_text = 'Julio'; break;
            case 8: $mes_text = 'Agosto'; break;
            case 9: $mes_text = 'Septiembre'; break;
            case 10: $mes_text = 'Octubre'; break;
            case 11: $mes_text = 'Noviembre'; break;
            case 12: $mes_text = 'Diciembre'; break;
        }
        return $mes_text;
    }