<?php
// Incluir a conexão
include 'conexao.php';

if (isset($_POST["adicionar"])) {
    
    // Recebe os dados do formulário
    $nome_acao = $_POST['acao'];
    $data_prevista = $_POST['dataP'];
    $investimento = $_POST['investimentoP'];



    // Preparar a consulta SQL para inserir os dados
    $sql = "INSERT INTO acao (codigo_acao, data_prevista, investimento) VALUES (?, ?, ?)";

    // Preparar a consulta
    if ($stmt = $conn->prepare($sql)) {
        // Bind dos parâmetros (i = inteiro, s = string, d = double)
        if (!$stmt->bind_param("isd", $nome_acao, $data_prevista, $investimento)) {
            echo "<script>alert('Erro ao associar os parâmetros: " . $stmt->error . "');</script>";
        } else {
            // Executa a consulta
            if ($stmt->execute()) {
                echo "<script>alert('Ação adicionada com sucesso!');</script>";
                echo "<script>window.location.href = 'index.php';</script>"; 
            } else {
                echo "<script>alert('Erro ao adicionar ação: " . $stmt->error . "');</script>";
            }
        }

        // Fecha a declaração
        $stmt->close();
    } else {
        // Mostrar o erro de preparação da consulta
        echo "<script>alert('Erro ao preparar a consulta: " . $conn->error . "');</script>";
    }
}

// Fecha a conexão
$conn->close();
?>

