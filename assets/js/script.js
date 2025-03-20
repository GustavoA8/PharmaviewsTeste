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

