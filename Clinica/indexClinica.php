<?php
require_once '../mysql.php';

$sqlClinica = "SELECT * FROM tb_clinica";
$listaClinica = selectRegistros($sqlClinica);

array_unshift($listaClinica,["clin_Id" => "","clin_Nome" => ""]);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clinica</title>
    <link href="../style.css" rel="stylesheet"></link>

</head>
<body>
    <div class="menu">
        <a class="menu_option" href="/index.php">Home</a>
        <a class="menu_option activated" href="">Clínica</a>
        <a class="menu_option" href="../CategoriaProduto/indexCategoriaProduto.php">Categoria Produto</a>
    </div>

    <h1>Clínica</h1>
    <hr>
    <form id="form" method="POST" action="insertClinica.php" onSubmit="return valida_dados(this)">
        <p>
            Id Clinica:
            <select name="idClin" onchange="updateButtons(this)">
            <?php
                foreach ($listaClinica as $tb_clinica){
            ?>
            <option value="<?php echo $tb_clinica['clin_Id'] ?>"><?php echo ucfirst(strtolower($tb_clinica['clin_Nome'])) ?></option>
            <?php
                }
            ?>
            </select>
            <br>
            <br>
            
            Nome Clínica:
            <input type="text" name="nomeClin" size="20">
        <br>
        <br>
            Telefone Clínica:
            <input type="text" name="telClin" size="20">
        <br>
        <br>
            Endereço Clínica:
            <input type="text" name="endeClin" size="20">               

        </p>
    </form>

    <input id="btnEnviar" type="button" value="Enviar" onclick="document.getElementById('form').action = './insertClinica.php'; document.getElementById('form').submit()">
    <input id="btnDeletar" type="button" value="Deletar" onclick="document.getElementById('form').action = './deleteClinica.php'; document.getElementById('form').submit()">
    <input id="btnAlterar" type="button" value="Alterar" onclick="document.getElementById('form').action = './updateClinica.php'; document.getElementById('form').submit()">

</body>
</html>