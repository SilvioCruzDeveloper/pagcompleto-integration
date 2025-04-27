<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../src/PedidoService.php';
require_once __DIR__ . '/../src/PagamentoGateway.php';
require_once __DIR__ . '/../src/Logger.php'; // ADICIONADO

// Carrega o Access Token do .env
$envPath = __DIR__ . '/../.env';
$env = parse_ini_file($envPath);
$accessToken = $env['ACCESS_TOKEN'];

$pedidoService = new PedidoService($pdo);
$gateway = new PagamentoGateway($accessToken);

// Busca todos os pedidos para processar
$pedidos = $pedidoService->buscarPedidosParaProcessar();

Logger::info("Iniciado processamento de pedidos.");

foreach ($pedidos as $pedido) {
    Logger::info("Processando pedido ID {$pedido['pedido_id']}.");

    $retorno = $gateway->processarPagamento($pedido);

    if (!$retorno) {
        Logger::error("Erro ao processar pedido ID {$pedido['pedido_id']}.");
        continue;
    }

    $novaSituacao = ($retorno['Error'] === false && $retorno['Transaction_code'] === "00") ? 2 : 3;

    // Atualiza pedido e pagamento
    $pedidoService->atualizarPedido(
        $pedido['pedido_id'],
        $novaSituacao,
        json_encode($retorno),
        $pedido['pagamento_id']
    );

    Logger::info("Pedido ID {$pedido['pedido_id']} atualizado para situação {$novaSituacao}.");
}

Logger::info("Finalizado processamento de pedidos.");
