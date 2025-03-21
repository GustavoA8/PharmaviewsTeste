# Sistema de Gestão de Ações de Marketing

Este projeto foi desenvolvido para um processo seletivo para uma vaga de Desenvolvedor Web. O objetivo é criar uma página que permita o cadastro e gerenciamento de ações de marketing, permitindo ao usuário definir o tipo de ação, a data prevista e o valor do investimento. A interface também deve permitir a edição e remoção de ações já cadastradas, oferecendo uma experiência interativa e eficiente.

## Objetivo

A solução visa resolver o problema de gerenciamento de orçamento de marketing, facilitando a distribuição das ações de marketing entre diferentes tipos de campanhas (ex: Palestra, Evento, Apoio Gráfico). A página permite que o usuário adicione novas ações de marketing, visualize as ações cadastradas em uma tabela e edite ou exclua registros existentes.

## Tecnologias Utilizadas

- **Frontend**:
  - **HTML5**: Estruturação da página e formulários.
  - **CSS3** (com Bootstrap 4): Estilização e layout responsivo.
  - **JavaScript** (com Fetch API): Interatividade e manipulação de dados no frontend.
  - **jQuery** (opcional): Para simplificar algumas interações.
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
