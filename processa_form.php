<?php
// Conecta ao banco de dados
$conn = new mysqli(hostname: "localhost", username: "root", password: "oracle12457878?", database: 'placas');

// Verifica conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Processa upload da imagem
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

// Insere dados no banco
$sql = "INSERT INTO placas (numero_placa, local_encontrado, foto_path, contato, municipio, seu_nome) 
        VALUES ('" . $_POST['numero_placa'] . "', '" . $_POST['local'] . "', '" . $target_file . "', '" . $_POST['contato'] . "','" . $_POST['municipio'] . "','" . $_POST['seu_nome'] . "')";

if ($conn->query($sql)) {
    echo "Placa cadastrada com sucesso!";
} else {
    echo "Erro: " . $conn->error;
}

$conn->close();
header("Location: index.php"); // Volta para a página inicial
?>