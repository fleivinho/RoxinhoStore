CREATE DATABASE IF NOT EXISTS inf261 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE inf261;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(120) NOT NULL UNIQUE,
  senha VARCHAR(100) NOT NULL,
  tipo VARCHAR(30) NOT NULL
);

-- Considero "Administrador" como admin do site

CREATE TABLE IF NOT EXISTS produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  descricao VARCHAR(255) NOT NULL,
  preco DECIMAL(10,2) NOT NULL,
  imagem VARCHAR(255) NOT NULL,
  tamanho VARCHAR(50) DEFAULT '',
  qtd INT DEFAULT 0
);

INSERT INTO produtos (nome, descricao, preco, imagem, tamanho, qtd)
SELECT 'Mouse Gamer Attack Shark X11 RGB Preto', 'Mouse gamer sem fio com 22000 DPI, 59g, tri-mode e dock magnetico.', 159.90, 'https://images.kabum.com.br/produtos/fotos/sync_mirakl/883180/Mouse-Gamer-Sem-Fio-Attack-Shark-X11-22000-Dpi-59g-Tri-mode-Com-Dock-Magn-tico-RGB-Preto_1772819622.jpg', '', 15
WHERE NOT EXISTS (SELECT 1 FROM produtos WHERE nome = 'Mouse Gamer Attack Shark X11 RGB Preto');

INSERT INTO produtos (nome, descricao, preco, imagem, tamanho, qtd)
SELECT 'Mouse Gamer Logitech G PRO X2 SUPERSTRIKE', 'Mouse gamer sem fio LIGHTSPEED com 61g, USB-C e cliques tateis personalizaveis.', 1019.91, 'https://images.kabum.com.br/produtos/fotos/1006946/mouse-gamer-sem-fio-logitech-g-pro-x2-superstrike-lightspeed-61g-cliques-tateis-personalizaveis-usb-c-preto-e-branco-910-007775_1781110136_original.jpg', '', 6
WHERE NOT EXISTS (SELECT 1 FROM produtos WHERE nome = 'Mouse Gamer Logitech G PRO X2 SUPERSTRIKE');

INSERT INTO produtos (nome, descricao, preco, imagem, tamanho, qtd)
SELECT 'Mouse Gamer Logitech G305 LIGHTSPEED Preto', 'Mouse gamer sem fio com 12000 DPI, 6 botoes e tecnologia LIGHTSPEED.', 179.99, 'https://images.kabum.com.br/produtos/fotos/97092/mouse-gamer-sem-fio-logitech-g305-lightspeed-12000-dpi-6-botoes-preto-910-005281_1781726494_original.jpg', '', 12
WHERE NOT EXISTS (SELECT 1 FROM produtos WHERE nome = 'Mouse Gamer Logitech G305 LIGHTSPEED Preto');

INSERT INTO produtos (nome, descricao, preco, imagem, tamanho, qtd)
SELECT 'PC Gamer Skill Ryzen 7 5700G com Monitor 27', 'PC gamer completo com Ryzen 7 5700G, 16GB, Radeon Vega 8, SSD 1TB M.2 e monitor 27 polegadas.', 3942.39, 'https://images.kabum.com.br/produtos/fotos/sync_mirakl/751805/PC-Gamer-Completo-Skill-Ryzen-7-5700g-16gb-Radeon-Vega-8-SSD-1TB-M-2-Monitor-27-Ips-100hz-Sk27004_1781786034.png', '', 4
WHERE NOT EXISTS (SELECT 1 FROM produtos WHERE nome = 'PC Gamer Skill Ryzen 7 5700G com Monitor 27');

INSERT INTO produtos (nome, descricao, preco, imagem, tamanho, qtd)
SELECT 'Mouse Gamer Redragon Cobra RGB Preto', 'Mouse gamer Redragon Cobra com Chroma RGB, 12400 DPI e 8 botoes.', 79.99, 'https://images.kabum.com.br/produtos/fotos/94555/mouse-gamer-redragon-cobra-chroma-rgb-10000dpi-7-botoes-preto-m711-v2_1742821619_original.jpg', '', 20
WHERE NOT EXISTS (SELECT 1 FROM produtos WHERE nome = 'Mouse Gamer Redragon Cobra RGB Preto');

INSERT INTO produtos (nome, descricao, preco, imagem, tamanho, qtd)
SELECT 'PC Gamer Ryzen 5 5600GT 16GB SSD 480GB', 'PC gamer completo com Ryzen 5 5600GT, 16GB DDR4, SSD 480GB e fonte 500W 80 Plus.', 3799.00, 'https://images.kabum.com.br/produtos/fotos/sync_mirakl/684007/PC-Gamer-Completo-Ryzen-5-5600gt-16gb-Ddr4-SSD-480GB-500w-80-Plus-PCgt13-e_1779735227.png', '', 5
WHERE NOT EXISTS (SELECT 1 FROM produtos WHERE nome = 'PC Gamer Ryzen 5 5600GT 16GB SSD 480GB');

INSERT INTO produtos (nome, descricao, preco, imagem, tamanho, qtd)
SELECT 'Monitor Gamer ASUS TUF 25 Full HD 200Hz', 'Monitor gamer ASUS TUF 25 polegadas, Full HD, 200Hz, 0.3ms, Fast IPS e HDR10.', 799.99, 'https://images.kabum.com.br/produtos/fotos/747517/monitor-gamer-asus-tuf-25-full-hd-200hz-0-3ms-fast-ips-vrr-g-sync-comp-freesync-premium-hdr10-som-integrado-preto-vg259q5a_1779197702_original.jpg', '', 9
WHERE NOT EXISTS (SELECT 1 FROM produtos WHERE nome = 'Monitor Gamer ASUS TUF 25 Full HD 200Hz');

INSERT INTO produtos (nome, descricao, preco, imagem, tamanho, qtd)
SELECT 'Monitor Gamer ASUS TUF 27 Full HD 240Hz', 'Monitor gamer ASUS TUF 27 polegadas, Full HD, 240Hz, 0.3ms, Fast IPS e HDR10.', 959.99, 'https://images.kabum.com.br/produtos/fotos/747518/monitor-gamer-asus-tuf-27-full-hd-240hz-0-3ms-fast-ips-vrr-g-sync-comp-freesync-premium-hdr10-som-integrado-preto-vg279qm5a_1779197513_original.jpg', '', 7
WHERE NOT EXISTS (SELECT 1 FROM produtos WHERE nome = 'Monitor Gamer ASUS TUF 27 Full HD 240Hz');

INSERT INTO produtos (nome, descricao, preco, imagem, tamanho, qtd)
SELECT 'Notebook Gamer Acer Nitro V15 Ryzen 7 RTX 4050', 'Notebook gamer Acer Nitro V15 com Ryzen 7-7735HS, 16GB RAM, RTX 4050, SSD 512GB e tela 15.6 Full HD.', 5699.05, 'https://images.kabum.com.br/produtos/fotos/sync_mirakl/952820/Notebook-Gamer-Acer-Nitro-V15-AMD-Ryzen-7-7735HS-16GB-RAM-RTX-4050-SSD-512-GB-Tela-15-6-Full-HD-Linux-64-Bits-Anv15-41-R2gt_1763054924.jpg', '', 3
WHERE NOT EXISTS (SELECT 1 FROM produtos WHERE nome = 'Notebook Gamer Acer Nitro V15 Ryzen 7 RTX 4050');

INSERT INTO produtos (nome, descricao, preco, imagem, tamanho, qtd)
SELECT 'Cadeira Gamer Husky Storm 100 Preta e Branca', 'Cadeira gamer Husky Storm 100 para ate 120kg, com almofadas e reclinacao de 135 graus.', 429.99, 'https://images.kabum.com.br/produtos/fotos/833991/cadeira-gamer-husky-storm-100-ate-120kg-almofadas-reclinavel-135-pu-preta-e-branca-hcg100ptbr_1774548809_original.jpg', '', 8
WHERE NOT EXISTS (SELECT 1 FROM produtos WHERE nome = 'Cadeira Gamer Husky Storm 100 Preta e Branca');

CREATE TABLE IF NOT EXISTS compras (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL,
  produto_id INT NOT NULL,
  preco DECIMAL(10,2) NOT NULL,
  data_compra DATETIME NOT NULL,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
);
