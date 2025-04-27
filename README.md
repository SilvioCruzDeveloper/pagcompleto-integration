# Integração Gateway PAGCOMPLETO

## Sobre o Projeto

Integração de pedidos do banco de dados PostgreSQL com o gateway PAGCOMPLETO, feita em **PHP puro** e ambiente **localhost**.

O objetivo é identificar pedidos aguardando pagamento, enviar para a API e atualizar o status conforme o retorno.

## Tecnologias Utilizadas

- PHP (sem frameworks)
- PostgreSQL
- Extensões PHP necessárias:
  - `pdo_pgsql`
  - `pgsql`
  - `curl`

## Como Executar

### 1. Requisitos

- PHP instalado
- PostgreSQL instalado
- Extensões PHP ativas: `pdo_pgsql`, `pgsql`, `curl`

### 2. Passos

1. Clone o repositório:
   ```bash
   git clone https://github.com/SilvioCruzDeveloper/pagcompleto-integration.git
   cd pagcompleto-integration
   ```

2. configure o `.env`:
   
   (Preencha com informações do banco e token.)

3. Importe no PostgreSQL as tabelas e dados fornecidos.

4. Inicie o servidor PHP:
   ```bash
   php -S localhost:8000 -t public
   ```

5. Em outro terminal, execute o processamento:
   ```bash
   php public/index.php
   ```

6. Consulte o `log.txt` para ver o que foi processado.

## Observações

- Desenvolvido e testado em ambiente local Linux Debian.
- Para Windows, é possível usar XAMPP:
  - Coloque o projeto na pasta `htdocs`.
  - Ative `pdo_pgsql`, `pgsql` e `curl` no `php.ini`.
  - Acesse via `http://localhost/pagcompleto-integration/public`.
  - Execute `php public/index.php` via terminal.

---

> Desenvolvido por **Silvio Cruz**
