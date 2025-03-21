<?php

include "conexao.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Garante que o ID seja um número inteiro

    // Prepara e executa a exclusão
    $sql = "DELETE FROM acao WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Item excluído com sucesso!";
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        echo "Erro ao excluir o item.";
    }


    $stmt->close();
    $conn->close();
} else {
    echo "ID inválido!";
}
?>