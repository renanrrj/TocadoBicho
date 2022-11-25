<?php
require_once '../mysql.php';

$sqlClinica = "SELECT * FROM tb_clinica";
$listaClinica = selectRegistros($sqlClinica);
$str_listaClinica = arrayToString($listaClinica);

array_unshift($listaClinica, ["clin_Id" => "", "clin_Nome" => ""]);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clínicas</title>
    <link href="../style.css" rel="stylesheet"></link>
    <script src="./controleClinica.js"></script>
</head>

<body>
    <p id="dadosString" style="max-height:0px; font-size:0px"><?php echo $str_listaClinica ?></p>

    <div class="menu">
        <a class="menu_option" href="../index.php">Home</a>
        <a class="menu_option activated">Clínicas</a>
        <a class="menu_option" href="../AnimalDoacao/indexAnimalDoacao.php">Animais para doação</a>
        <a class="menu_option" href="../CategoriaProduto/indexCategoriaProduto.php">Categorias de produto</a>
        <a class="menu_option" href="../Produto/indexProduto.php">Produtos</a>
        <a class="menu_option" href="../FormasPagamento/indexFormaPagamento.php">Formas de pagamento</a>
    </div>

    <h1>Clínicas</h1>
    <hr>
    <form id="form" method="POST" action="insertClinica.php">
        <p>
            Clínica:
            <select name="idClin" onchange="updateButtons(this)">
                <?php
                foreach ($listaClinica as $tb_clinica) {
                ?>
                    <option value="<?php echo $tb_clinica['clin_Id'] ?>"><?php echo ucfirst(strtolower($tb_clinica['clin_Nome'])) ?></option>
                <?php
                }
                ?>
            </select>
            <br>
            <br>
            Nome:
            <input id="clin_Nome" type="text" name="nomeClin" size="20">
            <br>
            <br>
            Telefone:
            <input id="clin_Telefone" type="number" name="telClin" size="20">
            <br>
            <br>
            Endereço:
            <input id="clin_Endereco" type="text" name="endeClin" size="20">
        </p>
    </form>

    <input id="btnEnviar" type="button" value="Enviar" onclick="document.getElementById('form').action = './insertClinica.php'; document.getElementById('form').submit()">
    <input id="btnDeletar" type="button" value="Deletar" onclick="document.getElementById('form').action = './deleteClinica.php'; document.getElementById('form').submit()" disabled>
    <input id="btnAtualizar" type="button" value="Alterar" onclick="document.getElementById('form').action = './updateClinica.php'; document.getElementById('form').submit()" disabled>

</body>

</html>