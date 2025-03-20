<?php

$hostname = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($hostname, $username, $password);
if($conn->connect_errno){
    die ("Falha ao conectar: (" . $conn->connect_errno . ") " . $conn ->connect_error);
}else{
    Echo"Sucesso";
}

// Criar o banco de dados se nao existir e a tabela

$dbname = "Pharmaviews";
$sql =  "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE){
    echo "Banco de dados verificado/criado com sucesso!<br>";
} else{
    die("Erro ao criar o banco: " . $conn->error);

}

$conn -> select_db($dbname);

// criando a tabela tipo_acao

$sql = "CREATE TABLE IF NOT EXISTS tipo_acao
(
    codigo_acao INT AUTO_INCREMENT PRIMARY KEY,
    nome_acao VARCHAR(100) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela tipo_acao criada com sucesso!";
} else {
    echo "Erro ao criar tabela tipo_acao: " . $conn->error;
}

$sql = "INSERT INTO tipo_acao (nome_acao) VALUES
('Palestra'),
('Evento'),
('Apoio'),
('Grafico')
";

if ($conn->query($sql) === TRUE) {
    echo "Dados da tabela tipo_acao inseridos com sucesso!";
} else {
    echo "Erro ao inserir dados da tabela tipo_acao: " . $conn->error;
}


//criando tabela acao

$sql = "CREATE TABLE IF NOT EXISTS acao
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_acao INT NOT NULL,
    investimento DOUBLE NOT NULL,
    data_prevista DATE NOT NULL,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (codigo_acao) REFERENCES tipo_acao (codigo_acao)
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela acao criada com sucesso!";
} else {
    echo "Erro ao criar tabela acao: " . $conn->error;
}


?>
