<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Placas Perdidas - Resultado da Busca</title>
</head>

<body>
    <h1>🔍 Placas Encontradas</h1>

    <?php
    require_once 'Database.php';

    try {
        $db = Database::connect();

        // Parâmetros da busca
        $numero_placa = $_GET['busca'] ?? '';
        $municipio = $_GET['municipio'] ?? '';

        // Monta a query dinamicamente
        $query = "SELECT * FROM placas WHERE 1=1";
        $params = [];

        if (!empty($numero_placa)) {
            $query .= " AND numero_placa LIKE :numero_placa";
            $params[':numero_placa'] = '%' . $numero_placa . '%';
        }

        if (!empty($municipio)) {
            $query .= " AND municipio = :municipio";
            $params[':municipio'] = $municipio;
        }

        $stmt = $db->prepare($query);
        $stmt->execute($params);

        $placas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($placas) {
            foreach ($placas as $row) {
                echo '<div class="placa-card">';
                echo '<img src="' . htmlspecialchars($row['foto_path']) . '" alt="Placa ' . htmlspecialchars($row['numero_placa']) . '">';
                echo '<p><strong>' . htmlspecialchars($row['numero_placa']) . '</strong><br>';
                echo 'Local encontrado: ' . htmlspecialchars($row['local_encontrado']) . '<br>';
                echo 'Município: ' . htmlspecialchars($row['municipio']) . '<br>';
                echo 'Contato: ' . htmlspecialchars($row['contato']) . '<br>';
                echo 'Nome: ' . htmlspecialchars($row['seu_nome']) . '</p>';
                echo '</div>';
            }
        } else {
            echo "Nenhuma placa encontrada com os critérios selecionados.";
        }

    } catch (Exception $e) {
        echo "Erro ao buscar placas: " . $e->getMessage();
    } finally {
        Database::disconnect();
    }
    ?>

</body>
</html>
