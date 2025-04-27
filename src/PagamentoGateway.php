<?php
// src/PagamentoGateway.php faz a chamada para a API PAGCOMPLETO para processar o pagamento de um pedido especifico e atualiza o status dos pedidos no banco de dados
class PagamentoGateway
{
    private $accessToken;
    private $urlBase = 'https://apiinterna.ecompleto.com.br/exams/processTransaction';

    // Inicializa a classe com o Access Token
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    // Envia o pagamento para a API PAGCOMPLETO
    public function processarPagamento($pedido)
    {
        $vencimento = str_replace('/', '', $pedido['vencimento']); // Ex: 08/2022 -> 0822

        $payload = [
            "external_order_id" => $pedido['pedido_id'],
            "amount" => $pedido['valor_total'],
            "card_number" => $pedido['num_cartao'],
            "card_cvv" => $pedido['codigo_verificacao'],
            "card_expiration_date" => $vencimento,
            "card_holder_name" => $pedido['nome_portador'],
            "customer" => [
                "external_id" => $pedido['cliente_id'],
                "name" => $pedido['nome'],
                "type" => "individual",
                "email" => $pedido['email'],
                "documents" => [
                    [
                        "type" => "cpf",
                        "number" => $pedido['cpf_cnpj']
                    ]
                ],
                "birthday" => date('Y-m-d', strtotime($pedido['data_nasc']))
            ]
        ];

        $url = $this->urlBase . "?accessToken=" . $this->accessToken;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
