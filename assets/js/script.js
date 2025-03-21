const tabela = document.getElementById("tabela-corpo")
const form = document.getElementById("form-modal");
document.getElementById("limpar").addEventListener("click", limpar);
console.log("Chamando js")

function adicionarAcao(){
    console.log("chamando addacao")
    tabela.innerHTML += `
    <tr class="table-active">
        <td></td>
        <td></td>
        <td></td>
        <td><img src="" alt=""></td>
        <td><img src="" alt=""></td>
    </tr>
    

    
    `

    
   
    
}
function limpar(){
    const input = document.querySelectorAll("input") 
    console.log(input)
    

    input[0].value = "";
    input[1].value = "";

    // for( input in i){
    //     input[i].value = "";
        
    event.defaultPrevented();

    

    
}
document.addEventListener("DOMContentLoaded", function () {
    // Quando o botão de edição for clicado
    document.querySelectorAll(".editar-btn").forEach(button => {
        button.addEventListener("click", function () {
            let acaoId = this.getAttribute("data-id"); // Pega o ID da ação
            document.getElementById("edit-id").value = acaoId;
            preencherModal(acaoId);
        });
    });

    // Adiciona o evento de submit ao formulário do modal
    const form = document.getElementById("#form-modal");
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        // Pega os dados do formulário
        const id = document.getElementById("edit-id").value;
        const codigo_acao = document.getElementById("edit-acao").value;
        const data_prevista = document.getElementById("edit-data").value;
        const investimento = document.getElementById("edit-investimento").value;

        console.log("Enviando dados:", id, codigo_acao, data_prevista, investimento);

        // Fazendo o envio via AJAX para o editar.php
        fetch('editar.php', {
            method: 'POST',
            body: new URLSearchParams({
                'id': id,
                'codigo_acao': codigo_acao,
                'data_prevista': data_prevista,
                'investimento': investimento
            }),
        })
        .then(response => response.text()) // Espera a resposta em texto
        .then(data => {
            alert(data); // Exibe a resposta de sucesso ou erro
            if (data.includes("Atualização bem-sucedida")) {
                // Se a atualização foi bem-sucedida, você pode fechar o modal ou atualizar a tabela
                $('#editModal').modal('hide'); // Fechar o modal automaticamente
                location.reload(); // Recarrega a página para atualizar os dados na tabela
            }
        })
        .catch(error => {
            console.error("Erro ao atualizar a ação:", error);
        });
    });
});

// Função que preenche o modal com os dados da ação
function preencherModal(acaoId) {
    console.log("Abrindo o modal para a ação com ID: " + acaoId);

    fetch('preencher_modal.php?id=' + acaoId)
        .then(response => response.json())
        .then(data => {
            if (data) {
                document.getElementById("edit-id").value = data.id;
                document.getElementById("edit-acao").value = data.codigo_acao;
                document.getElementById("edit-data").value = data.data_prevista;
                document.getElementById("edit-investimento").value = data.investimento;
            } else {
                alert("Erro: Dados da ação não encontrados.");
            }
        })
        .catch(error => {
            console.error("Erro ao buscar dados:", error);
        });
}