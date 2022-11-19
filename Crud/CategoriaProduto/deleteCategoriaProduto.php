<?php
require_once '../mysql.php';

$idCatProduto = $_POST['idCatPro'];
$validado = true;

$listaCatPro = [];

# Conferencia: se diferente de numerico validado se torna falso
if(!is_numeric($idCatProduto)){
    $validado = false;
}else{
    $sqlIdCatPro = "SELECT * FROM tb_categoriaproduto WHERE catpro_Id = $idCatProduto";
    $listaCatPro = selectRegistros($sqlIdCatPro);
}

# Verifica se há matéria com esse Id para poder deleta-la
if($listaCatPro=[]){
    $validado = false;
    echo "Deleção NÃO permitida, Id não encontrado";
}
if($validado){
    $sqlDelMateria = "DELETE FROM `tb_categoriaproduto` WHERE `catpro_Id` = $idCatProduto";
    $resultado = deleteRegistro($sqlDelMateria);
}

?>