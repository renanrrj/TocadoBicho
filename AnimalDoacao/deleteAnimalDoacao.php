<?php
require_once '../mysql.php';
session_start();

$idAnimal = $_POST['ani_Id'];

$listaAnimalDoacao = [];
$validado = true;
$erro = "";

//* Verifica se o produto selecionado para edição realmente existe na tabela
$sqlIdAnimalDoacao = "SELECT * FROM tb_animal where ani_Id = $idAnimal";
$listaIdAnimalDoacao = selectRegistros($sqlIdAnimalDoacao);

if ($listaIdAnimalDoacao == []) {
    $validado = false;
    $erro = $erro.'Não foi possível DELETAR, o registro não foi encontrado<br>';
}

//* Deletando o Dado
if ($validado) {
    $sqlDelAnimal = "DELETE FROM `tb_animal` WHERE `ani_Id` = $idAnimal";
    $resultado = deleteRegistro($sqlDelAnimal);

    $_SESSION['situacao'] = $resultado;
    $_SESSION['acao'] = 'Deleção';

    header('Location: ./indexAnimalDoacao.php');
} else {
    $_SESSION['situacao'] = $erro;
    header('Location: ./indexAnimalDoacao.php');
}

?>