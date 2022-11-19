<?php
require_once '../mysql.php';
session_start();

$fp_Id = $_POST['fp_Id'];
$validado = true;
$erro = "";

//* Verifica se o produto selecionado para edição realmente existe na tabela
$sqlIdFormaPagamento = "SELECT * FROM tb_formapagamento where fp_Id = $fp_Id";
$listaIdFormaPagamento = selectRegistros($sqlIdFormaPagamento);

if ($listaIdFormaPagamento == []) {
    $validado = false;
    $erro = $erro.'Não foi possível DELETAR, o registro não foi encontrado<br>';
}

//* Deletando o Dado
if ($validado) {
    $sqlDelPro = "DELETE FROM `tb_formapagamento` WHERE `fp_Id` = $fp_Id";
    $resultado = deleteRegistro($sqlDelPro);

    $_SESSION['situacao'] = $resultado;
    $_SESSION['acao'] = 'Deleção';

    header('Location: ./indexFormaPagamento.php');
} else {
    $_SESSION['situacao'] = $erro;
    header('Location: ./indexFormaPagamento.php');
}
?>