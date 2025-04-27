<?php
// Carrega as variáveis do .env

$envPath = __DIR__ . '/../.env';

if (file_exists($envPath)) {
    $env = parse_ini_file($envPath); // Lê o arquivo .env
} else {
    die('Arquivo .env não encontrado.');
}

// Valida as variáveis para garantir que não estão vazias
foreach (['DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USER', 'DB_PASS'] as $var) {
    if (empty($env[$var])) {
        die("A variável de ambiente {$var} não foi definida no arquivo .env.");
    }
}

// Monta a string de conexão
$dsn = "pgsql:host={$env['DB_HOST']};port={$env['DB_PORT']};dbname={$env['DB_NAME']};";

try {
    // Cria a conexão PDO
    $pdo = new PDO($dsn, $env['DB_USER'], $env['DB_PASS']);

    // Configura o PDO para lançar exceções em erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Forçar o encoding para UTF8 no PostgreSQL
    $pdo->exec("SET NAMES 'UTF8'");
    // Echo para confirmar que a conexão foi bem-sucedida
    echo "Conexão com o banco de dados foi realizada com sucesso";
} catch (PDOException $e) {
    // Captura e exibe erros de conexão
    die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
}
