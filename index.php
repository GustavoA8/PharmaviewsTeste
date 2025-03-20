<?php
// Incluir a conexão
include 'conexao.php';

$sql_acoes = "SELECT codigo_acao, nome_acao FROM tipo_acao";
$result_acoes = $conn->query($sql_acoes);

// Armazenar as opções de ações em um array
$acoes_lista = [];
if ($result_acoes->num_rows > 0) {
    while ($row = $result_acoes->fetch_assoc()) {
        $acoes_lista[] = $row;
    }
} else {
    echo "Nenhuma ação cadastrada.";
}

// Consulta para pegar os dados da tabela 'acoes'
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
    echo "Nenhuma ação cadastrada.";
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmaviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header>
        <nav>
            <!-- Offcanvas Sidebar -->
            <div class="offcanvas offcanvas-start" id="demo">
                <div class="offcanvas-header">
                    <h1 class="offcanvas-title">Heading</h1>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <p>Some text lorem ipsum.</p>
                    <p>Some text lorem ipsum.</p>
                    <button class="btn btn-secondary" type="button">A Button</button>
                </div>
            </div>

            <!-- Button to open the offcanvas sidebar -->
            <button id="icon-barras" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
                <img src="img/barras-icon.png" alt="">
            </button>

            <figure class="mt-3 ms-4"> <img src="img/logo3.png" style="width: 200px;" alt=""></figure>

        </nav>

    </header>
    <main>
        <h2 class="display-6 ms-5 mt-3">Gestão de Verbas</h2>
        <div id="box" class="container-fluid pt-3 pb-5">
            <form action="cadastrar.php" method="POST" >
                <div class="row">
                    <div class="col-xxl-3 col-sm-3">
                        <label for="acao" class="text-muted">Ação:</label>
                        <select name="acao" class="form-select">
                        <?php foreach ($acoes_lista as $acao) : ?>
                            <option value="<?php echo $acao['codigo_acao']; ?>"><?php echo $acao['nome_acao']; ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-xxl-3 col-sm-3">
                        <label for="acao" class="text-muted">Data prevista:</label>
                        <input type="date" class="form-control" name="dataP"  required>
                    </div>
                    <div class="col-xxl-3 col-sm-3">
                        <label for="acao" class="text-muted">Investimento previsto:</label>
                        <input type="number" class="form-control" placeholder="0,00" step="0.01" name="investimentoP" required>
                    </div>
                    <div class="col-xxl-3 col-sm-3">
                        <div class="group-btn text-center mt-4">
                            <button type="button" class="col-xxl-5 col-sm-5 py-1" id="limpar" >Limpar</button>
                            <button type="submit" class="col-xxl-5 py-1" id="add" name="adicionar">Adicionar</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive-sm">
                <table class="table table-hover table-bordered table-sm mt-4 ">
                    <thead>
                        <tr>
                            <th>Ação</th>
                            <th>Data prevista</th>
                            <th>Investimento previsto</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody id="tabela-corpo">
                        <?php if (!empty($acoes)) : ?>
                            <?php foreach ($acoes as $acao) : ?>
                                <tr class="table-active">
                                    <td><?php echo $acao['nome_acao']; ?></td>
                                    <td><?php echo $acao['data_prevista']; ?></td>
                                    <td><?php echo number_format($acao['investimento'], 2, ',', '.'); ?></td>
                                    <td><a href="editar.php?id=<?php echo $acao['id']; ?>">Editar</a></td>
                                    <td><a href="deletar.php?id=<?php echo $acao['id']; ?>">Excluir</a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5">Nenhuma ação cadastrada.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    </table>
            </div>
        </div>
    </main>
    <footer>
        <p class="text-white ms-5 mt-3 py-4">&copy 2024 <strong>PHARMAVIEWS</strong>. Todos os direitos reservados.</p>
    </footer>

</body>

<script src="assets/js/script.js"></script>
</html>
<?php
// Fechar a conexão apenas após terminar a exibição dos dados
$conn->close();
?>

