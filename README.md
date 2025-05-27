# Web-Servidor

Repositório referente ao Projeto 1 da disciplina Web Servidor utilizando PHP

Membros da equipe:

André Luiz Milek Magnani;

☑ Criar cadastro de usuários

☑ Criar cadastro de carro

☑ Salvar reserva e mostrar reservas do user logado na aba de listar reservas

☑ Adicionado composer com autoload

☑ Adicionado pacote simplerouter e configurado rotas transparentes

Thiago Moura Almeida;

☑ Criar login de usuários

☑ Criar página de listagem de carros

☑ Criar base do código seguindo o modelo mvc

☑ Criar notificação de reserva

☑ Criado e configurado banco de dados mysql

José Ricardo Schmitz Baptista;

☑ Criar validação de cadastro de carros

☑ Alterado css do código

☑ Adicionado orientação a objetos

☑ Alterado usuário admin para poder mudar função de outros users

# **Instalação e uso do projeto**

**Ferramentas necessárias**

PHP 8+

Xampp

Mysql

Para utilizar esse software, é necessário ter o xampp instalado e iniciar o apache e o mysql.

Para utilizar as rotas transparentes, você deve instalar o composer no seu computador e dentro do terminal do projeto deve usar o seguinte comando: composer require pecee/simple-router
O seu xampp deve estar configurado de acordo com o pdf de configuração na pasta config_xampp, além disso é necessário verificar no arquivo php.ini do apache se a linha 
extension=mysqli
está descomentada para o banco funcionar.

Após iniciar o apache e mysql, é necessário realizar o download do arquivo do projeto pelo github https://github.com/dedemm/Web-Servidor.

Após o download, você entra na pasta: "C:\xampp\htdocs" para salvar o arquivo do projeto nela.

É necessário importar o banco de dados que está na pasta download_db -> locadora.sql
Para fazer isso, é necessário clicar no botão admin do mysql pelo xampp após ele ter sido iniciado.
Ao abrir, você deve criar um novo banco de dados com o nome "locadora" e utf8_general_ci.
Após criar e entrar nesse banco, você deve clicar no botão importar na parte superior central da tela e importar o arquivo locadora.sql, com isso, seu banco estará pronto.


Para finalizar, você deve usar esse comando no terminal da pasta raiz do projeto (locadora-carros) para iniciar o servidor do PHP rodando em localhost na porta 8080

php -S localhost:8080





