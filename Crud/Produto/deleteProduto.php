<?php
require_once '../mysql.php';
session_start();

$pro_Id = $_POST['pro_Id'];
$validado = true;
$erro = "";

//* Verifica se o produto selecionado para edição realmente existe na tabela
$sqlIdProduto = "SELECT * FROM tb_produto where pro_Id = $pro_Id";
$listaIdProduto = selectRegistros($sqlIdProduto);

if ($listaIdProduto == []) {
    $validado = false;
    $erro = $erro.'Não foi possível DELETAR, o registro não foi encontrado<br>';
}

//* Deletando o Dado
if ($validado) {
    $sqlDelPro = "DELETE FROM `tb_produto` WHERE `pro_Id` = $pro_Id";
    $resultado = deleteRegistro($sqlDelPro);

    $_SESSION['situacao'] = $resultado;
    $_SESSION['acao'] = 'Deleção';

    header('Location: ./indexProduto.php');
} else {
    $_SESSION['situacao'] = $erro;
    header('Location: ./indexProduto.php');
}
?>