const tabela = document.getElementById("tabela-corpo")
const form = document.querySelector("form");
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
    const modal = document.getElementById("myModal");

    // Para cada botão de editar
    document.querySelectorAll(".editar-btn").forEach(button => {
        // Adicionar um evento de clique
        button.addEventListener("click", function (event) {
            event.preventDefault(); // Impede o comportamento padrão de navegação

            // Capturar os dados associados ao botão
            let id = this.dataset.id;  // ID da ação
            let acao = this.dataset.acao;  // Nome da ação (para debug)
            let acaoCodigo = this.dataset.acaoCodigo;  // O código da ação, que é o valor da opção na combobox
            let data = this.dataset.data;  // Data prevista
            let investimento = this.dataset.investimento;

            // Exibir os dados para depuração
            console.log("ID:", id, "Ação:", acao, "Código da Ação:", acaoCodigo, "Data:", data, "Investimento:", investimento);

            // Preencher os campos do modal com os dados
            document.getElementById("edit-id").value = id;  // O ID será usado para identificar a ação no banco
            document.getElementById("edit-investimento").value = investimento;  // Investimento

            // Preencher o campo de ação no modal (combobox)
            let editAcaoSelect = document.getElementById("edit-acao");

            // Agora, percorremos as opções da combobox e comparamos com o código da ação
            for (let i = 0; i < editAcaoSelect.options.length; i++) {
                if (editAcaoSelect.options[i].value === acaoCodigo) {
                    editAcaoSelect.selectedIndex = i;  // Se encontrado, seleciona
                    break;  // Interrompe o loop após encontrar a opção
                }
            }

            // Preencher o campo de data no modal (input de data)
            let editDataInput = document.getElementById("edit-data");
            editDataInput.value = data;  // Preenche com a data correta
        });
    });
});
    



