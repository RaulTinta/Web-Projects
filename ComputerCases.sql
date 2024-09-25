-- Active: 1715180405439@@localhost@3306@computercorner
CREATE TABLE ComputerCases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    imagine VARCHAR(255),
    descriere VARCHAR(255),
    tip_carcasa VARCHAR(50),
    dimensiune VARCHAR(50),
    sloturi_expansiune VARCHAR(50),
    pret DECIMAL(10, 2)
);

CREATE TABLE MotherBoards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    imagine VARCHAR(255),
    descriere VARCHAR(255),
    soclu_procesor VARCHAR(50),
    chipset_producator VARCHAR(50),
    chipset_model VARCHAR(50),
    tip_memorie VARCHAR(50),
    pret DECIMAL(10, 2)
);

CREATE TABLE RAMs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    imagine VARCHAR(255),
    descriere VARCHAR(255),
    tip VARCHAR(50),
    capacitate VARCHAR(50),
    frecventa VARCHAR(50),
    latenta_cas VARCHAR(50),
    pret DECIMAL(10, 2)
);

CREATE TABLE GPU (
    id INT AUTO_INCREMENT PRIMARY KEY,
    imagine VARCHAR(255),
    descriere VARCHAR(255),
    serie VARCHAR(50),
    boost_clock VARCHAR(50),
    tip_memorie VARCHAR(50),
    dimensiune_memorie VARCHAR(50),
    pret DECIMAL(10, 2)
);

CREATE TABLE CPU (
    id INT AUTO_INCREMENT PRIMARY KEY,
    imagine VARCHAR(255),
    descriere VARCHAR(255),
    serie VARCHAR(50),
    nucleu VARCHAR(50),
    frecventa VARCHAR(50),
    technologie_fabricatie VARCHAR(50),
    pret DECIMAL(10, 2)
);

CREATE TABLE PrebuiltComputers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    imagine VARCHAR(255),
    descriere VARCHAR(255),
    model_cpu VARCHAR(255),
    model_gpu VARCHAR(255),
    chipset VARCHAR(50),
    capacitate_ram VARCHAR(50),
    pret DECIMAL(10, 2)
);

CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume VARCHAR(255) NOT NULL,
    prenume VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    telefon VARCHAR(15),
    parola VARCHAR(255) NOT NULL,
    drepturi VARCHAR(50) NOT NULL DEFAULT 'client'
);

CREATE TABLE Cos (
    client_id INT,
    produs_id INT,
    produs_tip VARCHAR(50),
    cantitate INT
);

CREATE TABLE Comenzi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    adresa VARCHAR(255) NOT NULL,
    nume VARCHAR(255) NOT NULL,
    telefon VARCHAR(255) NOT NULL,
    modalitate_plata VARCHAR(255) NOT NULL,
    suma_totala DECIMAL(10, 2),
    produse TEXT,
    data_comanda DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Pagini (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume_pagina VARCHAR(100),
    url_pagina VARCHAR(255) NOT NULL,
    drepturi VARCHAR(50) NOT NULL
);


ALTER TABLE GPU CHANGE serie seria VARCHAR(50);

ALTER TABLE CPU CHANGE serie seria VARCHAR(50);
   
ALTER TABLE CPU CHANGE technologie_fabricatie tehnologie_fabricatie VARCHAR(50);

INSERT INTO Users (nume, prenume, email, telefon, parola, drepturi)
VALUES ('admin', '', 'admin', '0123456789', '$2y$10$L5QeR0g7rOfQNSufVXkT7uSAfJCSFhqAEjxn0YoEZLQjAmyPM4TqC', 'admin');

INSERT INTO Pagini (nume_pagina, url_pagina, drepturi)
VALUES
('Dashboard', 'Admin_Dashboard_tab.php', 'admin'),
('Computer Cases', 'Admin_Views/Computer Cases/Admin_ComputerCases_tab.php', 'admin'),
('', 'Admin_Views/Computer Cases/Admin_ComputerCases_AdaugareForm.php', 'admin'),
('', 'Admin_Views/Computer Cases/Admin_ComputerCases_ModificareForm.php', 'admin'),
('CPU', 'Admin_Views/CPU/Admin_CPU_tab.php', 'admin'),
('', 'Admin_Views/CPU/Admin_CPU_AdaugareForm.php', 'admin'),
('', 'Admin_Views/CPU/Admin_CPU_ModificareForm.php', 'admin'),
('GPU', 'Admin_Views/GPU/Admin_GPU_tab.php', 'admin'),
('', 'Admin_Views/GPU/Admin_GPU_AdaugareForm.php', 'admin'),
('', 'Admin_Views/GPU/Admin_GPU_ModificareForm.php', 'admin'),
('MotherBoards', 'Admin_Views/Mother Boards/Admin_MotherBoards_tab.php', 'admin'),
('', 'Admin_Views/Mother Boards/Admin_MotherBoards_AdaugareForm.php', 'admin'),
('', 'Admin_Views/Mother Boards/Admin_MotherBoards_ModificareForm.php', 'admin'),
('Prebuilt Computers', 'Admin_Views/Prebuilt - Computers/Admin_PrebuiltComputers_tab.php', 'admin'),
('', 'Admin_Views/Prebuilt - Computers/Admin_PrebuiltComputers_AdaugareForm.php', 'admin'),
('', 'Admin_Views/Prebuilt - Computers/Admin_PrebuiltComputers_ModificareForm.php', 'admin'),
('RAMs', 'Admin_Views/RAMs/Admin_RAMs_tab.php', 'admin'),
('', 'Admin_Views/RAMs/Admin_RAMs_AdaugareForm.php', 'admin'),
('', 'Admin_Views/RAMs/Admin_RAMs_ModificareForm.php', 'admin'),
('Comenzi', 'Admin_Views/Comenzi/Admin_Comenzi_tab.php', 'admin'),
('Dashboard', 'Client_Dashboard_tab.php', 'client'),
('Computer Cases', 'Client_Views/Computer Cases/Client_ComputerCases_tab.php', 'client'),
('', 'Client_Views/Computer Cases/Client_ComputerCases_AdaugareForm.php', 'client'),
('', 'Client_Views/Computer Cases/Client_ComputerCases_ModificareForm.php', 'client'),
('CPU', 'Client_Views/CPU/Client_CPU_tab.php', 'client'),
('', 'Client_Views/CPU/Client_CPU_AdaugareForm.php', 'client'),
('', 'Client_Views/CPU/Client_CPU_ModificareForm.php', 'client'),
('GPU', 'Client_Views/GPU/Client_GPU_tab.php', 'client'),
('', 'Client_Views/GPU/Client_GPU_AdaugareForm.php', 'client'),
('', 'Client_Views/GPU/Client_GPU_ModificareForm.php', 'client'),
('MotherBoards', 'Client_Views/Mother Boards/Client_MotherBoards_tab.php', 'client'),
('', 'Client_Views/Mother Boards/Client_MotherBoards_AdaugareForm.php', 'client'),
('', 'Client_Views/Mother Boards/Client_MotherBoards_ModificareForm.php', 'client'),
('Prebuilt Computers', 'Client_Views/Prebuilt - Computers/Client_PrebuiltComputers_tab.php', 'client'),
('', 'Client_Views/Prebuilt - Computers/Client_PrebuiltComputers_AdaugareForm.php', 'client'),
('', 'Client_Views/Prebuilt - Computers/Client_PrebuiltComputers_ModificareForm.php', 'client'),
('RAMs', 'Client_Views/RAMs/Client_RAMs_tab.php', 'client'),
('', 'Client_Views/RAMs/Client_RAMs_AdaugareForm.php', 'client'),
('', 'Client_Views/RAMs/Client_RAMs_ModificareForm.php', 'client'),
('Cos', 'Client_Views/Cos/Client_Cos_tab.php', 'client'),
('', 'Client_Views/Cos/Client_ComandaInfo_tab.php', 'client'),
('', 'Client_Views/Cos/Client_ConfirmareComanda_tab.html', 'client'),
('', 'Client_Views/Cos/IntroducereCard.html', 'client'),
('LogOut', 'Autentificare/LogOut.php', 'admin/client');


INSERT INTO Users (nume, prenume, email, telefon, parola, drepturi)
VALUES ('client', '', 'client', '0123456780', '$2y$10$JPuGIANNkDX0bcS5/u213OvVXRcTesTmzMKOkajHlYGaM1JiTDX06', 'client');

ALTER TABLE prebuiltcomputers ADD COLUMN discount INT;