const tabela = document.getElementById("tabela-corpo")
const form = document.querySelector("form");
form.addEventListener("submit", limpar);
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
    event.preventDefault();
    
}
function limpar(event){
    const input = document.querySelectorAll("input") 
    console.log(input)
    

    input[0].value = "";
    input[1].value = "";
    input[2].value = "";

    // for( input in i){
    //     input[i].value = "";
        
    // }
   
    event.preventDefault();

    
}
