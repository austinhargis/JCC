DROP SCHEMA IF EXISTS GARDENPLANNER;
CREATE SCHEMA GARDENPLANNER;
USE GARDENPLANNER;

CREATE TABLE Login (
	id			BIGINT		UNSIGNED	NOT NULL	AUTO_INCREMENT,
	password	VARCHAR(255)			NOT NULL,
	email		VARCHAR(255)			NOT NULL,
	firstname	VARCHAR(255)			DEFAULT NULL,
	lastname	VARCHAR(255)			DEFAULT NULL,
	PRIMARY KEY (id),
	UNIQUE index (email)
) ENGINE=InnoDB;

INSERT INTO Login 
SET email = "morganmatchette@yahoo.com",
	password = "$2y$10$lOORTha.pYutRHE7yW/J4OwyJEKeoS57f/swHmf6Hm9s9muC7d8vu";

CREATE TABLE Lookup (
	id				BIGINT			UNSIGNED	NOT NULL 	AUTO_INCREMENT,
	type			VARCHAR(255)				NOT NULL,
	value			VARCHAR(255)				NOT NULL,
	extra			JSON						DEFAULT NULL,
	PRIMARY KEY (id),
	INDEX (type),
	UNIQUE (type, value)
) ENGINE = InnoDB;
INSERT INTO Lookup (type, value) VALUES
	("Plant.type", "Herb"),
	("Plant.type", "Fruit"),
	("Plant.type", "Vegetable"),
	("image/jpeg", "jpeg");

CREATE TABLE Plant( 
	id				BIGINT			UNSIGNED	NOT NULL 	AUTO_INCREMENT,
	type			BIGINT			UNSIGNED 	NOT NULL,
	name			VARCHAR(30) 				NOT NULL,
	sun				VARCHAR(30),
	image			VARCHAR(255)				DEFAULT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY (type) REFERENCES Lookup (id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE = InnoDB;
INSERT INTO Plant (type, name, sun, image) VALUES
	(1, "Basil", "Full Sun", "/resource/image/basil.jpg"),
	(2, "Tomato", "Full Sun", "/resource/image/tomato.jpg"),
	(3, "Cucumber", "Full Sun", "/resource/image/cucumber.jpg"),
	(1, "Mint", "Part Shade", "/resource/image/peppermint.jpg"),
	(3, "Lettuce", "Part Shade", "/resource/image/lettuce.jpg"),
	(2, "Strawberry", "Full Sun", "/resource/image/strawberry.jpg");
	
CREATE TABLE Log ( 
	id				BIGINT			UNSIGNED	NOT NULL 	AUTO_INCREMENT,
	name			VARCHAR(30) 				NOT NULL,
	datesewn		DATE						NOT NULL,
	notes			VARCHAR(30),
	userid			BIGINT			UNSIGNED	NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY (userid) REFERENCES Login (id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = InnoDB;



