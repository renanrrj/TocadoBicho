<?php
require_once "../mysql.php";
session_start();

$fp_Nome = $_POST['fp_Nome'];
$fp_Parcelavel = $_POST['fp_Parcelavel'];
$validado = true;
$erro = "";

//* Verifica se existe algum campo obrigatório vazio
if(empty($fp_Nome) || empty($fp_Parcelavel)){
    $validado = false;
    $erro = "Não foi possível INSERIR, existem campos obrigatórios em branco<br>";
}

//* Verifica se algum dos campos contém os caracteres ';:/"
$uniao = $fp_Nome.$fp_Parcelavel;
if(strpos($uniao,"'") || strpos($uniao,";") || strpos($uniao,":") || strpos($uniao,"/") || strpos($uniao,'"')){
    $validado = false;
    $erro = $erro."Não foi possível INSERIR, não são permitidos os caracteres';:/".'"'."<br>";
}

//* Verifica já existe na tabela o nome digitado, não deve existir
$sqlNomeFormaPagamento = "SELECT * FROM tb_formapagamento where fp_Nome = '$fp_Nome'";
$listaNomeFormaPagamento = selectRegistros($sqlNomeFormaPagamento);

if ($listaNomeFormaPagamento != []) {
    $validado = false;
    $erro = $erro.'Não foi possível INSERIR, o nome passado já está em uso<br>';
}

//* Inserindo o Dado
if ($validado) {
    //* Geração de ID
    $idFp = 1;
    $idFpLivre = false;
    while ($idFpLivre == false) {
        $sqlIdFormaPagamento = "SELECT fp_Id FROM tb_formapagamento WHERE fp_Id = $idFp";
        $listaIdFormaPagamento = selectRegistros($sqlIdFormaPagamento);

        if ($listaIdFormaPagamento == []) {
            $idFpLivre = true;
        } else {
            $idFp++;
        }
    }

    $sqlInFp = "INSERT INTO `tb_formapagamento`(fp_Id, fp_Nome, fp_Parcelavel) VALUES ($idFp, '$fp_Nome', $fp_Parcelavel)";
    $resultado = insereRegistro($sqlInFp);

    $_SESSION['situacao'] = $resultado;
    $_SESSION['acao'] = 'Inserção';

    header('Location: ./indexFormaPagamento.php');
} else {
    $_SESSION['situacao'] = $erro;
    header('Location: ./indexFormaPagamento.php');
}
?>