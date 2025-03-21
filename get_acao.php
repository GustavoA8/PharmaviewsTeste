<?php
// Ativa a exibição de erros para depuração
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Incluir a conexão
include 'conexao.php';

// Definir o cabeçalho para JSON
header("Content-Type: application/json");

if (isset($_GET['id'])) {
    $acaoId = $_GET['id'];

    // Consulta para pegar os dados da ação com base no ID
    $sql = "SELECT a.id, ta.codigo_acao, ta.nome_acao, a.data_prevista, a.investimento 
            FROM acao a
            JOIN tipo_acao ta ON a.codigo_acao = ta.codigo_acao
            WHERE a.id = ?"; // Utilizamos um prepared statement para evitar SQL Injection

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $acaoId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Dados encontrados, retornar em formato JSON
        $acao = $result->fetch_assoc();

        // Agora, vamos pegar todas as ações para preencher o select
        $acoesQuery = "SELECT codigo_acao, nome_acao FROM tipo_acao";
        $acoesResult = $conn->query($acoesQuery);

        $acoes = [];
        while ($row = $acoesResult->fetch_assoc()) {
            $acoes[] = $row;
        }

        // Inclui as ações no retorno
        $acao['acoes'] = $acoes;

        echo json_encode($acao);  // Retorne a resposta como JSON
    } else {
        // Caso não encontre a ação
        echo json_encode(["error" => "Ação não encontrada"]);
    }
} else {
    echo json_encode(["error" => "ID não fornecido"]);
}

// Fechar a conexão
$conn->close();
?>

