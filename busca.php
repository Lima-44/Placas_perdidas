<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Placas Perdidas</title>
</head>

<body>
    <h1>🔍 Placas Encontradas</h1>

    <div class="gallery">
    <?php
    $conn = new mysqli(hostname: "localhost", username: "root", password: "oracle12457878?", database: 'placas');

    // Parâmetros da busca
    $numero_placa = $_GET['numero_placa'] ?? '';
    $municipio = $_GET['municipio'] ?? '';

    // Monta a query SQL
    $sql = "SELECT * FROM placas WHERE 1=1";

    if (!empty($numero_placa)) {
        $sql .= " AND numero_placa LIKE '%" . $conn->real_escape_string(string: $numero_placa) . "%'";
    }

    if (!empty($municipio)) {
        // Campo município da tabela
        $sql .= " AND municipio = '" . $conn->real_escape_string(string: $municipio) . "'";
    }

    $result = $conn->query($sql);

    // Exibe resultados (similar ao lista_placas.php)
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="placa-card">';
            echo '<img src="' . $row['foto_path'] . '" alt="Placa ' . $row['numero_placa'] . '">';
            echo '<p><strong>' . $row['numero_placa'] . '</strong><br>';
            echo 'Local: ' . $row['local_encontrado'] . '<br>';
            echo 'Local: ' . $row['municipio'] . '<br>';
            echo 'Contato: ' . $row['contato'] . '<br>';
            echo 'Nome: ' . $row['seu_nome'] . '</p>';
            echo '</div>';
        }
    } else {
        echo "Nenhuma placa encontrada com os critérios selecionados.";
    }

    $conn->close();

    ?>
    </div>
</body>
</html>