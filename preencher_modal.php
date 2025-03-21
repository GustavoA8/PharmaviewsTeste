<?php
// Incluir a conexão com o banco de dados
include 'conexao.php';

$sql = "SELECT codigo_acao, nome_acao FROM tipo_acao";
$result = $conn->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Preenche a variável $acoes_lista com os dados da consulta
    $acoes_lista = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $acoes_lista = [];
}

// Receber o ID da ação
$acaoId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Verificar se o ID foi passado corretamente
if ($acaoId > 0) {
    // Consulta para pegar os dados da ação com o ID informado
    $sql = "SELECT a.id, ta.codigo_acao, ta.nome_acao, a.data_prevista, a.investimento 
            FROM acao a
            JOIN tipo_acao ta ON a.codigo_acao = ta.codigo_acao
            WHERE a.id = $acaoId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Caso a consulta retorne dados
        $acao = $result->fetch_assoc();
        // Retorna os dados no formato JSON
        echo json_encode($acao);
    } else {
        // Caso não encontre a ação, retorna null
        echo json_encode(null);
    }
} else {
    // Caso o ID não seja válido, retorna null
    echo json_encode(null);
}

// Fechar a conexão
$conn->close();
?>





