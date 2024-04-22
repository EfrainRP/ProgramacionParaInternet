<?php
$file_name = $_FILES['archivo'] ['name'];//nombre real del archivo
$file_tmp = $_FILES['archivo'] ['tmp_name'];//nombre temporal del archivo

//Forma para determinar la extension del archivo
$arreglo = explode(".", $file_name);
$len = count($arreglo);
$pos = $len-1;
$ext = $arreglo[$pos];

$dir = "archivos/";//carpeta donde se guardan los archivos
$file_enc = md5_file($file_tmp);//nombre del archivo encriptado

echo "file_name: $file_name <br>";
echo "file_tmp: $file_tmp <br>";
echo "ext: $ext <br>";
echo "file_enc: $file_enc <br>";

if($file_name != ''){
    $fileName1 = "$file_enc.$ext";
    copy($file_tmp, $dir.$fileName1);
    echo "$fileNmae1";
}
?>