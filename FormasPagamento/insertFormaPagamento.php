<?php
require_once "../mysql.php";
session_start();

$fp_Nome = $_POST['pro_Nome'];
$fp_Parcelavel = $_POST['pro_Id_Categoria'];
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
$sqlNomeProduto = "SELECT * FROM tb_produto where pro_Nome = '$pro_Nome'";
$listaNomeProduto = selectRegistros($sqlNomeProduto);

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

    $sqlInPro = "INSERT INTO `tb_produto`(pro_Id, pro_Id_Categoria, pro_Nome, pro_Preco, pro_Detalhe) VALUES ($idPro, $pro_Id_Categoria, '$pro_Nome', $pro_Preco, '$pro_Detalhe')";
    $resultado = insereRegistro($sqlInPro);

    $_SESSION['situacao'] = $resultado;
    $_SESSION['acao'] = 'Inserção';

    // header('Location: ./indexProduto.php');
} else {
    $_SESSION['situacao'] = $erro;
    // header('Location: ./indexProduto.php');
}
?>