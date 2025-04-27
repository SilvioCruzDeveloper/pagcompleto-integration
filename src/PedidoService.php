<?php

class PedidoService
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Busca pedidos que precisam ser processados
    public function buscarPedidosParaProcessar()
    {
        $sql = "
            SELECT 
                p.id AS pedido_id,
                p.valor_total,
                c.id AS cliente_id,
                c.nome,
                c.email,
                c.cpf_cnpj,
                c.data_nasc,
                pp.id AS pagamento_id,
                pp.num_cartao,
                pp.nome_portador,
                pp.codigo_verificacao,
                pp.vencimento,
                pp.qtd_parcelas
            FROM pedidos p
            JOIN pedidos_pagamentos pp ON p.id = pp.id_pedido
            JOIN clientes c ON p.id_cliente = c.id
            JOIN lojas_gateway lg ON p.id_loja = lg.id_loja
            WHERE p.id_situacao = 1
              AND pp.id_formapagto = 3
              AND lg.id_gateway = 1
        ";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Atualiza o pedido após o processamento
    public function atualizarPedido($pedidoId, $novaSituacao, $retornoIntermediador, $pagamentoId)
    {
        // Atualiza a situação do pedido
        $stmtPedido = $this->pdo->prepare("UPDATE pedidos SET id_situacao = :situacao WHERE id = :id");
        $stmtPedido->execute([
            ':situacao' => $novaSituacao,
            ':id' => $pedidoId
        ]);

        // Atualiza o retorno intermediador no pagamento
        $stmtPagamento = $this->pdo->prepare("UPDATE pedidos_pagamentos SET retorno_intermediador = :retorno WHERE id = :id");
        $stmtPagamento->execute([
            ':retorno' => $retornoIntermediador,
            ':id' => $pagamentoId
        ]);
    }
}
