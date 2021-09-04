# PROJETO - PROVA TESTE DO IDEMA

## Comandos iniciais para rodar o projeto

- criar um banco de dados com nome 'idema'
  [Arquivo SQL de teste](https://github.com/Gusttavomarinho/idema_teste/blob/c99f0130079cec94a742620842f47a362337952a/@bd/idema_para_teste.sql)
- configurar no arquivo config.php , as variaveis de configuração do projeto , nome do banco , usuario , senha
- rodar o comando composer install

### Fluxo do caso de uso solicitação ( Usuario externo)

- logando com o usario : teste , senha : teste
- sera possivel realizar o fluxo do sistema de solicitação de acesso aos documentos do sistema , devido a este usuario esta cadastrado como perfil 2 no banco de dados e ja ter alguns processos disponiveis para ele

### Fluxo de aprovar ou nao as solicitações ( Central de atendimento )

- logando com o usario : admin , senha : admin

## OBS:

- sistema esta enviando email com uma conta de teste do gmail , que pode apresentar falhas , conta esta configurada no Mail/ServiceMail.php
- sistema esta online e funcional no link [ AQUI ](https://travis-ci.org/joemccann/dillinger)
