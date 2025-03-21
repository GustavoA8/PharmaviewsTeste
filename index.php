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
    // echo "Nenhuma ação cadastrada.";
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
    // echo "Nenhuma ação cadastrada.";
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
                    <h1 class="offcanvas-title">PharmaViews</h1>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <p>Autor: <a href="https://github.com/GustavoA8">Gustavo Araujo</a></p>
                    <a href="vizualizar.php"><button class="btn btn-secondary" type="button">Vizualizar o Banco de Dados</button></a>
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
        <form action="cadastrar.php" id="form-modal" method="POST" >
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
                        <input type="number" class="form-control" placeholder="R$ 0,00" step="0.01" name="investimentoP" required>
                    </div>
                    <div class="col-xxl-3 col-sm-3">
                        <div class="group-btn text-center mt-4">
                            <button type="button" class="col-xxl-5 col-sm-5 py-1" id="limpar" ><img  src="img/icon-borracha.png" alt=""> Limpar</button>
                            <button type="submit" class="col-xxl-5 col-sm-5 py-1" id="add" name="adicionar"><img class="mb-1" src="img/icon-add.png" alt="">Adicionar</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive-sm row">
                <table class="table table-hover table-bordered table-sm mt-4 ">
                    <thead>
                        <tr>
                            <th class="col-sm-3">Ação</th>
                            <th class="col-sm-3">Data prevista</th>
                            <th class="col-sm-3">Investimento previsto</th>
                            <th class="col-sm-2">Editar</th>
                            <th class="col-sm-2">Excluir</th>
                        </tr>
                    </thead>
                    <tbody id="tabela-corpo">
                        <?php if (!empty($acoes)) : ?>
                            <?php foreach ($acoes as $acao) : ?>
                                <tr class="table-active">
                                    <td class="col-sm-3"><?php echo $acao['nome_acao']; ?></td>
                                    <td class="col-sm-3"><?php echo $acao['data_prevista']; ?></td>
                                    <td class="col-sm-3"><span>R$ </span><?php echo number_format($acao['investimento'], 2, ',', '.'); ?></td>
                                    <td class="text-center col-sm-2">
    <button type="button" class="editar-btn"
        data-id="<?= htmlspecialchars($acao['id']); ?>"  
        data-bs-toggle="modal" data-bs-target="#myModal">
        <img src="img/icon-editar2.png" alt="">
    </button>
</td>                   
                                    
                                    <td class="text-center col-sm-2"><a href="deletar.php?id=<?php echo $acao['id']; ?>"><img id="excluir" src="img/icon-excluir.png" alt=""></a></td>
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
<!-- Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Editar Ação</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
<div class="modal-body">
    <form action="editar.php" method="POST">
        <!-- ID oculto para envio -->
        <input type="text" name="id" id="edit-id" readonly class="form-control">

        <div class="row">
        <div class="col-xxl-3 col-sm-3">
    <label for="edit-acao" class="text-muted">Ação:</label>
    <select name="codigo_acao" id="edit-acao" class="form-select">
        <!-- Loop para preencher as opções -->
        <?php foreach ($acoes_lista as $acao) : ?>
            <option value="<?php echo $acao['codigo_acao']; ?>">
                <?php echo $acao['nome_acao']; ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
            <div class="col-xxl-3 col-sm-3">
                <label for="edit-data" class="text-muted">Data prevista:</label>
                <input type="date" class="form-control" name="data_prevista" id="edit-data" required>
            </div>
            <div class="col-xxl-3 col-sm-3">
                <label for="edit-investimento" class="text-muted">Investimento previsto:</label>
                <input type="number" class="form-control" name="investimento" id="edit-investimento" step="0.01" required>
            </div>
            <div class="col-xxl-3 col-sm-3">
                <div class="group-btn text-center mt-4">
                    <button type="submit" class="col-xxl-5 col-sm-5 py-1 btn btn-primary">
                        Editar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>

        </div>
    </div>
</div>
<script src="assets/js/script.js"></script>
</html>
<?php
// Fechar a conexão apenas após terminar a exibição dos dados
$conn->close();
?>

