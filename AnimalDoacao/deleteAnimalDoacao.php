<?php
require_once '../mysql.php';

$idAnimal = $_POST['idAni'];


$validado = true;

$listaAnimalDoacao = [];

# Conferencia: se diferente de numerico validado se torna falso
if(!is_numeric($idAnimal)){
    $validado = false;
}else{
    $sqlIdAnimalDoacao = "SELECT * FROM tb_animal WHERE ani_Id = $idAnimal";
    $listaAnimalDoacao = selectRegistros($sqlIdAnimalDoacao);
}

# Verifica se há matéria com esse Id para poder deleta-la
if($listaAnimalDoacao=[]){
    $validado = false;
    echo "Deleção NÃO permitida, Id não encontrado";
}
if($validado){
    $sqlDelAnimalDoacao = "DELETE FROM `tb_animal` WHERE `ani_Id` = $idAnimal";
    $resultado = deleteRegistro($sqlDelAnimalDoacao);
}

?>