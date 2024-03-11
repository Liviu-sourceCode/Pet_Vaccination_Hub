

CREATE TABLE animale (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume VARCHAR(255),
    specie VARCHAR(255),
    varsta INT
);


CREATE TABLE vaccinuri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nume VARCHAR(255),
    tip VARCHAR(255)
    
);


CREATE TABLE administrare_vaccinuri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_animal INT,
    id_vaccin INT,
    data_aplicare DATE,
    FOREIGN KEY (id_animal) REFERENCES animale(id) ON DELETE CASCADE,
    FOREIGN KEY (id_vaccin) REFERENCES vaccinuri(id) ON DELETE CASCADE
);

