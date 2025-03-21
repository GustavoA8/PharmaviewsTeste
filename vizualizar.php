<?php
// Incluir a conexão
include 'conexao.php';

// Consulta para pegar as ações e seus respectivos tipos
$sql = "SELECT a.id, ta.nome_acao, a.data_prevista, a.investimento, a.data_cadastro 
        FROM acao a 
        JOIN tipo_acao ta ON a.codigo_acao = ta.codigo_acao";
$result = $conn->query($sql);

// Armazenar os dados para exibir
$acoes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $acoes[] = $row;
    }
} else {
    $acoes = []; // Nenhuma ação encontrada
}

// Consulta para pegar os tipos de ação
$sql_acoes = "SELECT codigo_acao, nome_acao FROM tipo_acao";
$result_acoes = $conn->query($sql_acoes);

// Armazenar as opções de ações em um array
$acoes_lista = [];
if ($result_acoes->num_rows > 0) {
    while ($row = $result_acoes->fetch_assoc()) {
        $acoes_lista[] = $row;
    }
} else {
    $acoes_lista = []; // Nenhum tipo de ação encontrado
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização das Ações - Pharmaviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header>
        <nav>
            <figure class="mt-3 ms-4"> <a href="index.php"><img  src="img/logo3.png" style="width: 200px;" alt=""></a></figure>
        </nav>
    </header>
    <main>
        <h2 class="display-6 ms-5 mt-3">Gestão de Verbas - Visualização</h2>
        <div id="box" class="container-fluid pt-3 pb-5">
            <!-- Tabela Ações -->
            <div class="table-responsive-sm row">
                <h3>Ações Cadastradas</h3>
                <table class="table table-hover table-bordered table-sm mt-4">
                    <thead>
                        <tr>
                            <th class="col-sm-3">Ação</th>
                            <th class="col-sm-3">Data prevista</th>
                            <th class="col-sm-3">Investimento previsto</th>
                            <th class="col-sm-2">Data de Cadastro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($acoes)) : ?>
                            <?php foreach ($acoes as $acao) : ?>
                                <tr>
                                    <td class="col-sm-3"><?php echo $acao['nome_acao']; ?></td>
                                    <td class="col-sm-3"><?php echo $acao['data_prevista']; ?></td>
                                    <td class="col-sm-3"><span>R$ </span><?php echo number_format($acao['investimento'], 2, ',', '.'); ?></td>
                                    <td class="col-sm-2"><?php echo $acao['data_cadastro']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">Nenhuma ação cadastrada.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- Fim da Tabela Ações -->

            <!-- Tabela Tipo de Ações -->
            <div class="table-responsive-sm row mt-5">
                <h3>Tipos de Ações</h3>
                <table class="table table-hover table-bordered table-sm mt-4">
                    <thead>
                        <tr>
                            <th class="col-sm-3">Código da Ação</th>
                            <th class="col-sm-3">Nome da Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($acoes_lista)) : ?>
                            <?php foreach ($acoes_lista as $acao_lista) : ?>
                                <tr>
                                    <td class="col-sm-3"><?php echo $acao_lista['codigo_acao']; ?></td>
                                    <td class="col-sm-3"><?php echo $acao_lista['nome_acao']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2">Nenhum tipo de ação cadastrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- Fim da Tabela Tipo de Ações -->
             <div class="w-100 text-center"> <a href="index.php"><button type="button" class="btn btn-primary">Voltar</button></a></div>
        </div>
    </main>
    <footer>
        <p class="text-white ms-5 mt-3 py-4">&copy 2024 <strong>PHARMAVIEWS</strong>. Todos os direitos reservados.</p>
    </footer>
</body>

</html>

