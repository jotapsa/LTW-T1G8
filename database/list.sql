/*Formatting Output*/
.header on
.mode column
--.timer on

/*Allow Foreign Keys*/
PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS List;
DROP TABLE IF EXISTS Item;

CREATE TABLE User(
  idUser      INTEGER PRIMARY KEY,
  Username    TEXT    UNIQUE,
  Password    TEXT,
  Nickname    TEXT,
  Email       TEXT    NOT NULL,
  Photo       BLOB,
);

CREATE TABLE List (
  idList    INTEGER   PRIMARY KEY,
  Privacy   INTEGER   CHECK ((Privacy = 0 OR Privacy = 1) AND Privacy IS NOT NULL),
  Likes     INTEGER   CHECK (Likes>=0 AND Likes IS NOT NULL),
  Tag   TEXT    ,
    FOREIGN KEY (idUser) REFERENCES User
);


CREATE TABLE Item (
    idItem    INTEGER   PRIMARY KEY,
    FOREIGN KEY (idList) REFERENCES List
);
