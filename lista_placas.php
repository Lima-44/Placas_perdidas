<?php
$conn = new mysqli("localhost", "root", "oracle12457878?", "placas");
$sql = "SELECT * FROM placas ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="placa-card">';
        echo '<img src="' . $row['foto_path'] . '" alt="Placa ' . $row['numero_placa'] . '">';
        echo '<strong>' . $row['numero_placa'] . '</strong><br>';
        echo 'Local: ' . $row['local_encontrado'] . '<br>';
        echo 'Local: ' . $row['municipio'] . '<br>';
        echo 'Contato: ' . $row['contato'] . '<br>';
        echo 'Nome: ' . $row['seu_nome'] . '</p>';
        echo '</div>';
    }
} else {
    echo "Nenhuma placa cadastrada ainda.";
}
$conn->close();
?>