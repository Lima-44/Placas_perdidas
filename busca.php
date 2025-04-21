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

    <?php
    $conn = new mysqli(hostname: "localhost", username: "root", password: "oracle12457878?", database: 'placas');

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }


    // Parâmetros da busca
    $numero_placa = $_GET['numero_placa'] ?? '';
    $municipio = $_GET['municipio'] ?? '';

    // Monta a query SQL
    $sql = "SELECT * FROM placas WHERE 1=1";

    if (!empty($placa)) {
        $sql .= "AND numero_placa LIKE '%$placa%' ";
    }

    if (!empty($municipio)) {
        $sql .= "AND municipio = '$municipio' ";
    }

    $result = $conn->query($sql);

    // Exibe resultados (similar ao lista_placas.php)
    if ($result->num_rows > 0) {
        echo '<div class="gallery">';
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
        echo '</div>';
    } else {
        echo "Nenhuma placa encontrada com os critérios selecionados.";
    }

    $conn->close();

    ?>

</body>

</html>