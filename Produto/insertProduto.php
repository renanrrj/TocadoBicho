<?php
require_once "../mysql.php";
session_start();

$pro_Id_Categoria = $_POST['pro_Id_Categoria'];
$pro_Nome = $_POST['pro_Nome'];
$pro_Preco = $_POST['pro_Preco'];

//* Verifica já existe na tabela o nome digitado, não deve existir
$sqlNomeProduto = "SELECT * FROM tb_produto where pro_Nome = '$pro_Nome'";
$listaNomeProduto = selectRegistros($sqlNomeProduto);

$validado = true;
$erro = "";

if ($listaNomeProduto != []) {
    $validado = false;
    $erro = $erro.'Não foi possível INSERIR, o nome passado já está em uso<br>';
}

//* Verifica se a categoria de produto escolhida existe atualmente, deve existir
$sqlCatProduto = "SELECT * FROM tb_categoriaproduto where catpro_Id = $pro_Id_Categoria";
$listaCatProduto = selectRegistros($sqlCatProduto);

if ($listaCatProduto == []) {
    $validado = false;
    $erro = $erro.'Não foi possível INSERIR, a categoria escolhida não existe mais, atualize a página e tente novamente<br>';
}

//* Verifica se o preço digitado é válido
if (!is_numeric($pro_Preco) || $pro_Preco < 1){
    $validado = false;
    $erro = $erro.'Não foi possível INSERIR, o preço não pode ser negativo, nem zero e deve ser um número<br>';
}

//* Inserindo o Dado
if ($validado) {
    //* Geração de ID
    $idPro = 1;
    $idProLivre = false;
    while ($idProLivre == false) {
        $sqlIdProduto = "SELECT pro_Id FROM tb_produto WHERE pro_Id = $idPro";
        $listaIdProduto = selectRegistros($sqlIdProduto);

        if ($listaIdProduto == []) {
            $idProLivre = true;
        } else {
            $idPro++;
        }
    }

    $sqlInPro = "INSERT INTO `tb_produto`(pro_Id, pro_Id_Categoria, pro_Nome, pro_Preco) VALUES ($idPro, $pro_Id_Categoria, '$pro_Nome', $pro_Preco)";
    $resultado = insereRegistro($sqlInPro);

    $_SESSION['situacao'] = $resultado;

    header('Location: ./indexProduto.php');
} else {
    $_SESSION['situacao'] = $erro;
    header('Location: ./indexProduto.php');
}
