<?php
// Conecta ao banco de dados
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = Database::connect();

    try {
        $db->beginTransaction();

        // Processa o upload da imagem
        $target_dir = "uploads/";
        $filename = basename($_FILES["foto"]["name"]);
        $target_file = $target_dir . $filename;

        if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            throw new Exception('Falha no upload da imagem.');
        }

        // Prepara o insert seguro
        $stmt = $db->prepare("INSERT INTO placas (numero_placa, local_encontrado, foto_path, contato, municipio, seu_nome) 
                              VALUES (:numero_placa, :local_encontrado, :foto_path, :contato, :municipio, :seu_nome)");

        $stmt->bindParam(':numero_placa', $_POST['numero_placa']);
        $stmt->bindParam(':local_encontrado', $_POST['local']);
        $stmt->bindParam(':foto_path', $target_file);
        $stmt->bindParam(':contato', $_POST['contato']);
        $stmt->bindParam(':municipio', $_POST['municipio']);
        $stmt->bindParam(':seu_nome', $_POST['seu_nome']);

        $stmt->execute();

        $db->commit();

        echo "Placa cadastrada com sucesso!";
    } catch (Exception $e) {
        if ($db->inTransaction()) {
            $db->rollBack();
        }
        echo "Erro: " . $e->getMessage();
    } finally {
        Database::disconnect();
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>