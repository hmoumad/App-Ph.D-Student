CREATE DATABASE IF NOT EXISTS `doctorat`;
USE `doctorat`;

CREATE TABLE `login`
(
  `admin` VARCHAR(50) NOT NULL,
  `password` VARCHAR(50) NOT NULL
);

Insert into `login` values('Admin','12345');

CREATE TABLE `docteur`
(
	`CODE_Doc` INT NOT NULL,
  `CIN_Doc` VARCHAR(20) NOT NULL,
	`CNE_Doc` VARCHAR(20) NOT NULL,
	`Nom_fr` VARCHAR(20) NOT NULL,
	`Nom_arab` VARCHAR(20) NOT NULL,
	`Prenom_fr` VARCHAR(20) NOT NULL,
	`Prenom_arab` VARCHAR(20) NOT NULL,
	`Date_Naissance` DATE NOT NULL,
	`Lieu_Naiss_fr` VARCHAR(50) NOT NULL,
	`Lieu_Naiss_arab` VARCHAR(40) NOT NULL,
	`Centre_Etude_doctorale` VARCHAR(50) NOT NULL,
	`Formation` VARCHAR(50) NOT NULL,
	`Specialite` VARCHAR(50) NOT NULL,

    PRIMARY KEY(`CODE_Doc`)
);
ALTER TABLE `docteur`
ADD CONSTRAINT CK_UNIQUE UNIQUE(`CNE_Doc`,`CIN_Doc`);



CREATE TABLE `jury` 
(
  `CIN_J` VARCHAR(10) NOT NULL,
  `Nom_J` VARCHAR(40) NOT NULL,
  `Nom_J_arab` VARCHAR(40) NOT NULL,
  `Prenom_J` VARCHAR(40) NOT NULL,
  `Prenom_J_arab` VARCHAR(40) NOT NULL,

  PRIMARY KEY(`CIN_J`)
);


CREATE TABLE `soutenance` 
(
  `id_soutenance` SMALLINT NOT NULL,
  `CODE_Doc` INT NOT NULL,
  `CIN_J` VARCHAR(10) NOT NULL,
  `Titre_Travail` TEXT NOT NULL,
  `Date_Soutenance` DATE NOT NULL,
  `Grade_J` VARCHAR(40) NOT NULL CHECK(Grade_J IN ('PA','PH','PES','Docteur')),
  `Statut_J` VARCHAR(30) NOT NULL CHECK(Statut_J IN ('Président','Rapporteur','Examinateur','Directeur de thése','Co-Directeur de thése','Invité')),
  `Etablissement_J` VARCHAR(50) NOT NULL,

  FOREIGN KEY(`CODE_Doc`) REFERENCES `docteur`(`CODE_Doc`),
  FOREIGN KEY(`CIN_J`) REFERENCES `jury`(`CIN_J`)
);
ALTER TABLE `soutenance` 
ADD CONSTRAINT PK_SOUTENANCE PRIMARY KEY(`id_soutenance`,`CODE_Doc`,`CIN_J`);