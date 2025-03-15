CREATE TABLE clubs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    date_creation DATE,
    logo VARCHAR(255),
    reseaux_sociaux VARCHAR(255)
);
INSERT INTO clubs (nom, description, date_creation, logo, reseaux_sociaux) 
VALUES 
('Enactus ESSECT', 'Club d’entrepreneuriat social', '2015-03-20', 'images/enactus.jpg', 'https://www.facebook.com/enactus.essect'),
('InfoLab', 'Club de technologie et d’innovation', '2017-06-12', 'images/infolab.jpg', 'https://www.linkedin.com/infolab.essect');
