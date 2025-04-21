<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Placas Perdidas</title>
</head>

<body>
    <div class="container">
        <h1>🔍 Placas Perdidas</h1>
        <form action="processa_form.php" method="POST" enctype="multipart/form-data">
            <h2>Cadastrar Placa Encontrada</h2>
            <input type="text" name="numero_placa" placeholder="Número da Placa" required>
            <input type="text" name="local" placeholder="Onde foi encontrada?" required>
            <input type="text" name="municipio" placeholder="Município onde foi encontrada" required>
            <input type="file" name="foto" accept="image/*" required>
            <input type="text" name="contato" placeholder="Seu WhatsApp" required>
            <input type="text" name="seu_nome" placeholder="Seu nome" required>
            <button type="submit">Enviar</button>
        </form>

        <hr>

        <h2>Buscar Placa</h2>
        <form action="busca.php" method="GET">
            <input type="text" name="busca" placeholder="Digite o número da placa">
            <select name="municipio" id="select-municipio">
                <option value="">Todos os municípios</option>

            </select>
            <button type="submit">Buscar</button>
        </form>

        <div class="gallery">
            <?php include 'lista_placas.php'; ?>
        </div>
    </div>
</body>

</html>