<?php
require_once 'Database.php';

try {
    $db = Database::connect();

    $stmt = $db->prepare("SELECT * FROM placas ORDER BY id DESC LIMIT 10");
    $stmt->execute();
    $placas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($placas) {
        foreach ($placas as $row) {
            echo '<div class="placa-card">';
            echo '<img src="' . htmlspecialchars($row['foto_path']) . '" alt="Placa ' . htmlspecialchars($row['numero_placa']) . '">';
            echo '<strong>' . htmlspecialchars($row['numero_placa']) . '</strong><br>';
            echo 'Local encontrado: ' . htmlspecialchars($row['local_encontrado']) . '<br>';
            echo 'Município: ' . htmlspecialchars($row['municipio']) . '<br>';
            echo 'Contato: ' . htmlspecialchars($row['contato']) . '<br>';
            echo 'Nome: ' . htmlspecialchars($row['seu_nome']);
            echo '</div>';
        }
    } else {
        echo "Nenhuma placa cadastrada ainda.";
    }
} catch (Exception $e) {
    echo "Erro ao buscar placas: " . $e->getMessage();
} finally {
    Database::disconnect();
}