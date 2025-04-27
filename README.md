# Integração Gateway PAGCOMPLETO

## Sobre o Projeto

Este projeto consiste em integrar pedidos de uma base de dados PostgreSQL com o gateway de pagamento PAGCOMPLETO. Desenvolvido em PHP puro, com estrutura organizada e configurado para rodar em ambiente local via `localhost`.

O objetivo principal é identificar pedidos aguardando pagamento e processá-los automaticamente através da API do gateway, atualizando o status conforme o retorno da API.

---

## Tecnologias Utilizadas

- PHP (sem frameworks)
- PostgreSQL
- cURL (extensão do PHP)
- Ambiente local no Linux Debian

---

## Como Executar o Projeto

1. Clone o repositório:

```bash
git clone https://github.com/SilvioCruzDeveloper/pagcompleto-integration.git

Acesse a pasta:
cd pagcompleto-integration
Configure o arquivo .env com as informações do seu banco de dados e token de acesso.

Importe no PostgreSQL as tabelas e dados necessários.

Acesse o diretório public e execute:

php -S localhost:8000
Em outro terminal, execute o processamento dos pedidos:

php public/index.php
Consulte o log.txt para ver o que foi processado.

Observações
A conexão ao banco e a comunicação com a API foram feitas utilizando PHP nativo.

Todos os testes e processamento foram realizados em ambiente local, simulando um servidor real (localhost).

Foi utilizado PostgreSQL instalado diretamente no Debian, sem uso de pacotes como XAMPP ou similares.
```
