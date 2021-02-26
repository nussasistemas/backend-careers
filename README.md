## O aplicativo

Este é um sistema de cadastro de vagas de emprego com possibilidade de inclusão, alteração e remoção de vagas de emprego, sendo:
Frontend - Visualização das vagas vísiveis aberta ao público final
Backend - Painel de gerenciamento de cadastro de vagas de emprego de acesso restrito à usuários com login e senha

## Acesso público

O conteúdo ja estará disponível na raiz da url '/'

## Acesso restrito

O administrador terá as seguintes opções de endereço:
/login : formulário de login no sistema.
/logout : estado o usuário logado no sistema, bastará acessar este endereço para que a sessão seja encerrada
/registration : onde poderá ser criado o acesso à área administrativa
/job : tela principal do backend com a listagem

## Requisitos do sistema

O sistema foi desenvolvido utilizando o framework Symfony (PHP). Para o devido funcionamento, deverá ter instalado os seguintes recursos:

- nginx ou Apache 2
- PHP 7
- MySQL 5
- Composer
- Symfony 5

## Instruções sobre a instalação

- Passo 1: faça um clone do repositório: https://github.com/nussasistemas/talentify.git
- Passo 2: crie um usuário no banco de dados MySQL com permissões plenas de criação de um banco de dados.
- Passo 3: crie um banco de dados com nome à sua escolha.
- Passo 4: de posse do username, password e banco de dados criados no MySQL, altere as informações dentro do arquivo '.env' na raiz '/' do sistema
- Passo 5: faça a cópia do arquivo './database_vagas.sql' para o MySQL usando o comando:
  - 'sudo mysql -u username -p database_name < database_vagas.sql', substituia username e database_name pelos nomes definos nos Passos 2 e 3
- Passo 5: dentro da pasta raiz '/' do sistema, execute o comando:
  - 'composer install'

Neste ponto, o sistema já estará pronto para ser utilizado e poderá ser acessar pelo endereço definido para ele.

## Instruções de uso

Como o banco de dados gerado está vazio, será necessário criar um novo usuário para acessar a Área Administrativa e cadastrar as vagas. Para isso, acesse:

- /registration
- Será aberto um formulário onde deverão ser preenchidos os dados do usuário que irá cadastrar as vagas no sistema
- Depois disso, basta cadastrar as vagas e utilizar o sistema

Enjoy (:
