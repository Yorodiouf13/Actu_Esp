CREATE DATABASE IF NOT EXISTS mglsi_news_mvc;
USE mglsi_news_mvc;

DROP TABLE IF EXISTS Article, Categorie;

CREATE TABLE Categorie(
    id INT PRIMARY KEY AUTO_INCREMENT,
    libelle VARCHAR(20)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

CREATE TABLE Article(
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255),
    contenu TEXT,
    dateCreation DATETIME DEFAULT NOW(),
    dateModification DATETIME DEFAULT NOW() ON UPDATE NOW(),
    categorie INT,
    FOREIGN KEY (categorie) REFERENCES Categorie(id)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;


INSERT INTO Categorie(libelle) VALUES ('Sport'), ('Santé'), ('Education'), ('Politique');

INSERT INTO Article (titre, contenu, categorie, dateCreation) VALUES 
    ('Lancement d''un nouveau programme de Master en IA', 
    'L''Université a récemment annoncé le lancement d''un programme de Master en Intelligence Artificielle. Ce programme vise à former des experts capables de répondre aux défis technologiques actuels. Les cours incluent des modules sur l''apprentissage automatique, la vision par ordinateur et le traitement du langage naturel. Les étudiants auront également accès à des laboratoires équipés de technologies de pointe pour mener des projets innovants.', 
    3, NOW()),
    ('Le Sénégal remporte la CAN 2025', 
    'Dans un match historique, l''équipe nationale du Sénégal a remporté la Coupe d''Afrique des Nations 2025. Le match final, qui s''est déroulé à Dakar, a vu une performance exceptionnelle de l''attaquant vedette qui a marqué deux buts décisifs. Cette victoire marque un tournant dans l''histoire du football sénégalais et a été célébrée par des milliers de supporters à travers le pays.', 
    1, '2025-03-15 14:30:00'),
    ('Conférence sur la santé mentale en milieu universitaire', 
    'Une conférence internationale sur la santé mentale en milieu universitaire s''est tenue à l''Université. Les experts ont discuté des défis auxquels les étudiants sont confrontés, notamment le stress académique, l''anxiété et la dépression. Des solutions innovantes, telles que des programmes de soutien psychologique et des ateliers de gestion du stress, ont été proposées pour améliorer le bien-être des étudiants.', 
    2, '2025-02-20 10:00:00'),
    ('Élections présidentielles : un tournant pour la Mauritanie', 
    'Les élections présidentielles en Mauritanie ont suscité un grand intérêt cette année. Avec un taux de participation record, les citoyens ont exprimé leur volonté de changement. Le nouveau président élu a promis de mettre en œuvre des réformes économiques et sociales pour améliorer les conditions de vie de la population.', 
    4, '2025-01-10 09:00:00'),
    ('Inauguration d''un centre sportif ultramoderne', 
    'L''Université a inauguré un nouveau centre sportif équipé des dernières technologies. Ce centre comprend une piscine olympique, des terrains de football et de basketball, ainsi qu''une salle de musculation. L''objectif est de promouvoir le sport et le bien-être parmi les étudiants et le personnel.', 
    1, NOW()),
    ('L''Université s''engage pour le développement durable', 
    'Dans le cadre de son engagement pour le développement durable, l''Université a lancé plusieurs initiatives, notamment l''installation de panneaux solaires sur les bâtiments du campus et la mise en place d''un système de tri sélectif des déchets. Ces actions visent à réduire l''empreinte carbone de l''institution et à sensibiliser les étudiants aux enjeux environnementaux.', 
    3, '2025-04-01 08:00:00'),
    ('Vaccination obligatoire contre la grippe pour les étudiants', 
    'Face à une recrudescence des cas de grippe, l''Université a décidé de rendre la vaccination obligatoire pour tous les étudiants. Des centres de vaccination ont été installés sur le campus pour faciliter l''accès au vaccin. Cette mesure vise à protéger la communauté universitaire et à éviter une propagation massive du virus.', 
    2, '2025-03-05 11:00:00'),
    ('Forum sur l''entrepreneuriat étudiant', 
    'Un forum sur l''entrepreneuriat étudiant a été organisé par l''Université, réunissant des experts, des investisseurs et des jeunes entrepreneurs. Les participants ont eu l''occasion de présenter leurs projets innovants et de recevoir des conseils pour développer leurs idées en entreprises viables. Plusieurs projets prometteurs ont attiré l''attention des investisseurs présents.', 
    3, '2025-02-25 15:00:00'),
    ('Crise politique au Sénégal : manifestations étudiantes', 
    'Suite à une crise politique majeure au Sénégal, des manifestations ont éclaté dans plusieurs universités du pays. Les étudiants réclament des réformes démocratiques et une meilleure gestion des ressources publiques. Les autorités universitaires ont appelé au calme tout en soutenant le droit des étudiants à exprimer leurs opinions.', 
    4, '2025-03-10 13:00:00'),
    ('Programme de bourses pour les étudiants sportifs', 
    'L''Université a lancé un programme de bourses destiné aux étudiants sportifs. Ce programme vise à soutenir les jeunes talents qui excellent dans leur discipline tout en poursuivant leurs études. Les bénéficiaires recevront une aide financière ainsi qu''un accès privilégié aux installations sportives du campus.', 
    1, NOW());

ALTER TABLE Article ADD CONSTRAINT fk_categorie_article FOREIGN KEY(categorie) REFERENCES Categorie(id);

CREATE USER 'mglsi_user'@'localhost' IDENTIFIED BY 'passer';
GRANT ALL PRIVILEGES ON mglsi_news.* TO 'mglsi_user'@'localhost';
FLUSH PRIVILEGES;

CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (username, password) VALUES ('admin', 'admin123');