<?php
require_once __DIR__ . '/../config/db.php';

// Consulta simples para listar todos os pedidos
$sql = "SELECT id, valor_total, valor_frete, data, id_cliente, id_loja, id_situacao FROM pedidos ORDER BY id ASC";

try {
    $stmt = $pdo->query($sql); // Executa a consulta SQL
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtem os resultados como um array associativo
} catch (PDOException $e) {
    die("Erro ao buscar pedidos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Lista de Pedidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h1>Pedidos no Banco de Dados</h1>

    <?php if (count($pedidos) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Valor Total</th>
                    <th>Valor Frete</th>
                    <th>Data</th>
                    <th>ID Cliente</th>
                    <th>ID Loja</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?= htmlspecialchars($pedido['id']) ?></td>
                        <td>R$ <?= number_format($pedido['valor_total'], 2, ',', '.') ?></td>
                        <td>R$ <?= number_format($pedido['valor_frete'], 2, ',', '.') ?></td>
                        <td><?= htmlspecialchars($pedido['data']) ?></td>
                        <td><?= htmlspecialchars($pedido['id_cliente']) ?></td>
                        <td><?= htmlspecialchars($pedido['id_loja']) ?></td>
                        <td><?= htmlspecialchars($pedido['id_situacao']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum pedido encontrado.</p>
    <?php endif; ?>

</body>

</html>