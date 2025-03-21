# Sistema de Gestão de Ações de Marketing

Este projeto foi desenvolvido para um processo seletivo para uma vaga de Desenvolvedor Web. O objetivo é criar uma página que permita o cadastro e gerenciamento de ações de marketing, permitindo ao usuário definir o tipo de ação, a data prevista e o valor do investimento. A interface também deve permitir a edição e remoção de ações já cadastradas, oferecendo uma experiência interativa e eficiente.

## Objetivo

A solução visa resolver o problema de gerenciamento de orçamento de marketing, facilitando a distribuição das ações de marketing entre diferentes tipos de campanhas (ex: Palestra, Evento, Apoio Gráfico). A página permite que o usuário adicione novas ações de marketing, visualize as ações cadastradas em uma tabela e edite ou exclua registros existentes.

## Tecnologias Utilizadas

- **Frontend**:
  - **HTML5**: Estruturação da página e formulários.
  - **CSS3**: Estilização e layout responsivo.
  - **JavaScript**: Interatividade e manipulação de dados no frontend.
  - **Bootstrap**: Framework para layout responsivo e componentes de interface.

- **Backend**:
  - **PHP**: Lógica de servidor e integração com o banco de dados.
  - **MySQL**: Banco de dados para armazenar informações das ações de marketing e tipos de ação.

## Funcionalidades

### 1. Cadastro de Ações
- O usuário pode selecionar o tipo de ação (ex: Palestra, Evento, Apoio Gráfico) de um **select** preenchido a partir dos dados do banco.
- A data prevista para a ação deve ser maior ou igual a 10 dias da data de cadastro.
- O valor do investimento é inserido pelo usuário em um campo numérico.

### 2. Listagem de Ações
- Todas as ações cadastradas são exibidas em uma tabela.
- As colunas exibem a **ação**, **data prevista** e **investimento**.
  
### 3. Edição de Ações
- O usuário pode editar os dados de uma ação existente, como o tipo de ação, a data prevista e o valor do investimento.
- Ao clicar no botão de editar, os campos do modal são preenchidos com os dados da ação selecionada.

### 4. Exclusão de Ações
- O usuário pode excluir uma ação clicando em um botão de excluir ao lado da ação na tabela.

## Estrutura do Banco de Dados

O banco de dados contém duas tabelas principais:

1. **tipo_acao**: Define os tipos de ações de marketing (ex: Palestra, Evento, Apoio Gráfico).
2. **acao**: Armazena as ações de marketing cadastradas, associando cada ação a um tipo de ação.

```sql
-- Criação da tabela tipo_acao
CREATE TABLE IF NOT EXISTS tipo_acao
(
    codigo_acao INT AUTO_INCREMENT PRIMARY KEY,
    nome_acao VARCHAR(100) NOT NULL
);

-- Criação da tabela acao
CREATE TABLE IF NOT EXISTS acao
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_acao INT,
    investimento DOUBLE,
    data_prevista DATE,
    data_cadastro DATE,
    FOREIGN KEY (codigo_acao) REFERENCES tipo_acao (codigo_acao)
);

**Como Executar o Projeto:**
1. Verifique se o PHP esta instalado na sua maquina.
2. Instale o <a href="https://www.apachefriends.org/pt_br/download.html">XAMPP</a>.
3. Clone o repositorio com ´git clone https://github.com/GustavoA8/PharmaviewsTeste.git´
4. Coloque a pasta PharmaviewsTeste no seguinte local C:\xampp\htdocs (esse local foi criado quando você instalou o xampp).
5. Inicie o XAMPP.
6. Dentro do xampp de start no Apache e no MySQL.
7. Abra o seu navegador e digite http://localhost/Pharmaviewsteste/index.php para acessar a página principal.
8. Agora pode testar o projeto.

*Nota: não é necessario a criação da tabela ou do banco de dados o projeto cria automaticamente.

## Autor

Este projeto foi desenvolvido por <a href="https://github.com/GustavoA8"Gustavo Araujo</a>.

## Licença

Este projeto está licenciado sob a <a href="https://opensource.org/licenses/MIT">Licença MIT</a>
