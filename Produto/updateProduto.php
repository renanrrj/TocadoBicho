<?php
require_once '../mysql.php';
session_start();

$pro_Id = $_POST['pro_Id'];
$pro_Id_Categoria = $_POST['pro_Id_Categoria'];
$pro_Nome = $_POST['pro_Nome'];
$pro_Preco = $_POST['pro_Preco'];
$pro_Detalhe = $_POST['pro_Detalhe'];
$validado = true;
$erro = "";

//* Verifica já existe na tabela o nome digitado, não deve existir
if(empty($pro_Id) || empty($pro_Id_Categoria) || empty($pro_Nome) || empty($pro_Preco) || empty($pro_Detalhe)){
    $validado = false;
    $erro = "Não foi possível ALTERAR, existem campos em branco<br>";
}

//* Verifica se algum dos campos contém os caracteres ';:/"
$uniao = $pro_Id.$pro_Id_Categoria.$pro_Nome.$pro_Preco.$pro_Detalhe;
if(strpos($uniao,"'") || strpos($uniao,";") || strpos($uniao,":") || strpos($uniao,"/") || strpos($uniao,'"')){
    $validado = false;
    $erro = $erro."Não foi possível ALTERAR, não são permitidos os caracteres ';:/".'"'."<br>";
}

//* Verifica se o produto selecionado para edição realmente existe na tabela
$sqlIdProduto = "SELECT * FROM tb_produto where pro_Id = $pro_Id";
$listaIdProduto = selectRegistros($sqlIdProduto);

if ($listaIdProduto == []) {
    $validado = false;
    $erro = $erro.'Não foi possível ALTERAR, o registro não foi encontrado<br>';
}

//* Verifica já existe na tabela o nome digitado sem ser no registro atual, não deve existir
$sqlNomeProduto = "SELECT * FROM tb_produto where pro_Nome = '$pro_Nome' and pro_Id != $pro_Id";
$listaNomeProduto = selectRegistros($sqlNomeProduto);

if ($listaNomeProduto != []) {
    $validado = false;
    $erro = $erro.'Não foi possível ALTERAR, o nome passado já está em uso<br>';
}

//* Verifica se a categoria de produto escolhida existe atualmente, deve existir
$sqlCatProduto = "SELECT * FROM tb_categoriaproduto where catpro_Id = $pro_Id_Categoria";
$listaCatProduto = selectRegistros($sqlCatProduto);

if ($listaCatProduto == []) {
    $validado = false;
    $erro = $erro.'Não foi possível ALTERAR, a categoria escolhida não existe mais, atualize a página e tente novamente<br>';
}

//* Verifica se o preço digitado é válido
if (!is_numeric($pro_Preco) || $pro_Preco < 1){
    $validado = false;
    $erro = $erro.'Não foi possível ALTERAR, o preço não pode ser negativo, nem zero e deve ser um número<br>';
}

//echo "erro: ".var_dump($erro);
//* Alterando o Dado
if ($validado) {
    $sqlUpPro = "UPDATE `tb_produto` SET `pro_Id_Categoria` = $pro_Id_Categoria, `pro_Nome` = '$pro_Nome', `pro_Preco` = $pro_Preco, `pro_Detalhe` = '$pro_Detalhe' WHERE `pro_Id` = $pro_Id";
    $resultado = updateRegistro($sqlUpPro);

    $_SESSION['situacao'] = $resultado;
    $_SESSION['acao'] = 'Alteração';

    echo "Passou: $resultado";
    header('Location: ./indexProduto.php');
} else {
    $_SESSION['situacao'] = $erro;
    header('Location: ./indexProduto.php');
}
?>