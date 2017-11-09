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
  idUser      INTEGER PRIMARY KEY,
  username    TEXT UNIQUE,
  password    TEXT,
  nickname    TEXT,
  email       TEXT    NOT NULL,
  photo       BLOB,
);

CREATE TABLE List(
  idList    INTEGER   PRIMARY KEY,
  privacy   INTEGER   CHECK ((Privacy = 0 OR Privacy = 1) AND Privacy IS NOT NULL),
  title     TEXT      ,
  likes     INTEGER   CHECK (Likes>=0 AND Likes IS NOT NULL),
  idUser    INTEGER   NOT NULL,
    FOREIGN KEY (idUser) REFERENCES User
);

CREATE TABLE Tag(
  idTag     INTEGER   PRIMARY KEY,
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
  idItem    INTEGER   PRIMARY KEY,
    FOREIGN KEY (idList) REFERENCES List
);

INSERT INTO User VALUES(NULL,'john', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220','John','john@fe.up.pt',NULL);
