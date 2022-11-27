<?php
require_once "../mysql.php";

$nomeClinica = $_POST['nomeClin'];
$telClinica = $_POST['telClin'];
$endeClinica = $_POST['endeClin'];
$validado = true;


# Verifica se em clin_nome já existe o digitado em nomeCatProduto
$sqlClinica = "SELECT * FROM tb_clinica where clin_Nome = '$nomeClinica'"; 
$listaClinica = selectRegistros($sqlClinica);

if($listaClinica != []){
    $validado = false;
    echo 'NÃO foi possível INSERIR';
}


# Verifica se existe algum campo obrigatório vazio e ativa o erro "nao foi possivel INSERIR,..."
if(empty($nomeClinica) || empty($telClinica) || empty($endeClinica) ){
    $validado = false;
    $erro = "Não foi possível INSERIR, existem campos obrigatórios em branco<br>";
}

# Verifica se algum dos campos contém os caracteres '§¬/"
$uniao = $nomeClinica.$telClinica.$endeClinica;
if(strpos($uniao,"'") || strpos($uniao,"§") || strpos($uniao,"¬") || strpos($uniao,"|") || strpos($uniao,'"') || strpos($uniao,'.')){
    $validado = false;
    $erro = $erro."Não foi possível INSERIR, não são permitidos os caracteres '§¬|".'"'."<br>";
}

//* Verifica se o telefone é válido
if (!is_numeric($telClinica)){
    $validado = false;
    $erro = $erro.'Não foi possível INSERIR, idade não pode ser negativa e deve ser um número<br>';
}


# Geração de ID
$idClinica =1;
$idClinicaLivre = false;
while ($idClinicaLivre == false){    
    $sqlIdClinica = "SELECT clin_Id FROM tb_clinica WHERE clin_Id = $idClinica";
    $listaIdClinica = selectRegistros($sqlIdClinica);

    if($listaIdClinica == []){
        $idClinicaLivre = true;
    }else{
        $idClinica++;
    }
}

#Inserindo o Dado
if($validado){
    $sqlInClinica = "INSERT INTO `tb_clinica`(clin_Id, clin_Nome, clin_Telefone, clin_Endereco) VALUES ($idClinica, '$nomeClinica', '$telClinica', '$endeClinica')";
    $resultdo = insereRegistro($sqlInClinica);    
}else{
    echo 'dados inválidos';
}
?>