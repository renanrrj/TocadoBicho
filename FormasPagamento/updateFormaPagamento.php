<?php
require_once "../mysql.php";
session_start();

$fp_Id = $_POST['fp_Id'];
$fp_Nome = $_POST['fp_Nome'];
$fp_Parcelavel = $_POST['fp_Parcelavel'];
$validado = true;
$erro = "";

//* Verifica se a forma de pagamento selecionada para edição realmente existe na tabela
$sqlIdFormaPagamento = "SELECT * FROM tb_produto where pro_Id = $fp_Id";
$listaIdFormaPagamento = selectRegistros($sqlIdFormaPagamento);

if ($listaIdFormaPagamento == []) {
    $validado = false;
    $erro = $erro.'Não foi possível ALTERAR, o registro não foi encontrado<br>';
}

//* Verifica se existe algum campo obrigatório vazio
if(empty($fp_Nome) || empty($fp_Parcelavel)){
    $validado = false;
    $erro = "Não foi possível ALTERAR, existem campos obrigatórios em branco<br>";
}

//* Verifica se algum dos campos contém os caracteres ';:/"
$uniao = $fp_Nome.$fp_Parcelavel;
if(strpos($uniao,"'") || strpos($uniao,";") || strpos($uniao,":") || strpos($uniao,"|") || strpos($uniao,'"')){
    $validado = false;
    $erro = $erro."Não foi possível ALTERAR, não são permitidos os caracteres';:|".'"'."<br>";
}

//* Verifica já existe na tabela o nome digitado, não deve existir
$sqlNomeFormaPagamento = "SELECT * FROM tb_formapagamento where fp_Nome = '$fp_Nome'";
$listaNomeFormaPagamento = selectRegistros($sqlNomeFormaPagamento);

if ($listaNomeFormaPagamento != []) {
    $validado = false;
    $erro = $erro.'Não foi possível ALTERAR, o nome passado já está em uso<br>';
}

//* Inserindo o Dado
if ($validado) {
    //* Geração de ID
    $sqlUpFp = "UPDATE `tb_formapagamento` SET fp_Nome = '$fp_Nome', fp_Parcelavel = $fp_Parcelavel WHERE fp_Id = $fp_Id";
    $resultado = updateRegistro($sqlUpFp);

    $_SESSION['situacao'] = $resultado;
    $_SESSION['acao'] = 'Alteração';

    header('Location: ./indexFormaPagamento.php');
} else {
    $_SESSION['situacao'] = $erro;
    header('Location: ./indexFormaPagamento.php');
}
?>