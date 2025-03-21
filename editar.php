<?php
include 'conexao.php'; // Inclui a conexão com o banco de dados

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verifica se os dados esperados estão sendo recebidos
    if (isset($_POST['id']) && isset($_POST['codigo_acao']) && isset($_POST['data_prevista']) && isset($_POST['investimento'])) {
        
        // Obtém os dados enviados pelo formulário
        $id = $_POST['id']; // ID da ação
        $codigo_acao = $_POST['codigo_acao']; // Código da ação
        $data_prevista = $_POST['data_prevista']; // Data prevista
        $investimento = $_POST['investimento']; // Investimento

        // Depuração para ver os valores
        error_log("ID: $id, Código Ação: $codigo_acao, Data: $data_prevista, Investimento: $investimento");

        // Preparando a consulta de update
        $sql = "UPDATE acao SET 
                codigo_acao = ?, 
                data_prevista = ?, 
                investimento = ? 
                WHERE id = ?";

        // Preparando a query
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssdi", $codigo_acao, $data_prevista, $investimento, $id);

            // Executando a query
            if ($stmt->execute()) {
                // Sucesso: retorna uma resposta
                echo "Atualização bem-sucedida!";
                echo "<script>window.location.href = 'index.php';</script>"; 
            } else {
                // Erro ao executar o update
                echo "Erro ao atualizar: " . $stmt->error;
            }

            // Fechar a conexão
            $stmt->close();
        } else {
            echo "Erro ao preparar a query: " . $conn->error;
        }
    } else {
        echo "Dados faltando no formulário!";
    }
} else {
    echo "Método de requisição inválido!";
}

$conn->close();
?>


