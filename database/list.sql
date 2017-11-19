/*Formatting Output*/
.header on
.mode column
--.timer on

/*Allow Foreign Keys*/
PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS List;
DROP TABLE IF EXISTS Tag;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Item;

CREATE TABLE User(
  idUser      INTEGER PRIMARY KEY AUTOINCREMENT,
  username    TEXT    UNIQUE,
  password    TEXT    NOT NULL,
  birthday    INTEGER NOT NULL,
  registerDate    INTEGER NOT NULL,
  gender      INTEGER CHECK ((gender=0 OR gender=1) AND gender IS NOT NULL),
  nickname    TEXT    NOT NULL,
  email       TEXT    NOT NULL,
  image       TEXT
);

CREATE TABLE List(
  idList    INTEGER   PRIMARY KEY AUTOINCREMENT,
  privacy   INTEGER   CHECK ((privacy = 0 OR privacy = 1) AND privacy IS NOT NULL),
  title     TEXT      NOT NULL,
  colour    TEXT      NOT NULL,
  likes     INTEGER   CHECK (likes>=0 AND likes IS NOT NULL),
  clones    INTEGER   CHECK (clones>=0 AND clones IS NOT NULL),
  checked   INTEGER   CHECK ((checked=0 OR checked=1) AND checked IS NOT NULL),
  image       TEXT,
  editedDate    INTEGER NOT NULL,
  idUser    INTEGER   NOT NULL,
    FOREIGN KEY (idUser) REFERENCES User
);

CREATE TABLE Tag(
  idTag     INTEGER   PRIMARY KEY AUTOINCREMENT,
  name      TEXT      UNIQUE
);

CREATE TABLE Category(
  idList    INTEGER   NOT NULL,
  idTag     INTEGER   NOT NULL,
  PRIMARY KEY(idList, idTag),
    FOREIGN KEY (idList) REFERENCES List,
    FOREIGN KEY (idTag)  REFERENCES Tag
);


CREATE TABLE Item (
  idItem    INTEGER   PRIMARY KEY AUTOINCREMENT,
  info      TEXT      NOT NULL,
  checked   INTEGER   CHECK ((checked = 0 OR checked = 1) AND checked IS NOT NULL),
  dateUntil   INTEGER NOT NULL,
  idList    INTEGER   NOT NULL,
    FOREIGN KEY (idList) REFERENCES List
);
-- Users
INSERT INTO User VALUES(NULL,'john', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220',1508074451,1508074451,0,'John','john@fe.up.pt',NULL);

-- Lists
INSERT INTO List VALUES(NULL,0,'Exemplo','ff0000',0,0,0,NULL,1511118000,1);

-- Items
INSERT INTO Item VALUES(NULL,'Projeto LTW',0,1513328400,1);
INSERT INTO Item VALUES(NULL,'Projeto LAIG',0,1513328400,1);

-- Category
INSERT INTO Category VALUES(1,1);
INSERT INTO Category VALUES(1,2);
INSERT INTO Category VALUES(1,3);

-- Tags
INSERT INTO Tag VALUES(NULL,'feup');
INSERT INTO Tag VALUES(NULL,'ltw');
INSERT INTO Tag VALUES(NULL,'laig');
