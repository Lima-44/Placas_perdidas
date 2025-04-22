CREATE TABLE IF NOT EXISTS placas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_placa VARCHAR(10) NOT NULL,
    local_encontrado VARCHAR(255) NOT NULL,
    foto_path VARCHAR(255) NOT NULL,
    contato VARCHAR(100),
    municipio VARCHAR(100),
    seu_nome VARCHAR(100),
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);