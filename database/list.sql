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
DROP TABLE IF EXISTS Belongs;

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
  color    TEXT      NOT NULL,
  checked   INTEGER   CHECK ((checked=0 OR checked=1) AND checked IS NOT NULL),
  editedDate    INTEGER NOT NULL
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
  idList    INTEGER   NOT NULL,
    FOREIGN KEY (idList) REFERENCES List
);

CREATE TABLE Belongs(
  idList INTEGER NOT NULL,
  idUser INTEGER NOT NULL,
  PRIMARY KEY (idList, idUser),
    FOREIGN KEY (idList) REFERENCES List,
    FOREIGN KEY (idUser) REFERENCES User
);

-- Users
INSERT INTO User VALUES(NULL,'john', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',755827200,1512864000,0,'John','john@fe.up.pt',NULL);
INSERT INTO User VALUES(NULL,'barbosa', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',859939200,1512864000,0,'Barbosa','barbosa@fe.up.pt','images/barbosa.jpg');
INSERT INTO User VALUES(NULL,'jotapsa', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',837302400,1512864000,0,'João Sá','jotapsa@fe.up.pt','images/jotapsa.png');
INSERT INTO User VALUES(NULL,'arthur', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',852076800,1512864000,0,'Arthur Matta','arthur@fe.up.pt','images/arthur.jpg');

-- Lists
INSERT INTO List VALUES(NULL,0,'Projetos','#ff0000',0,1512864000);
INSERT INTO List VALUES(NULL,0,'Trabalho Prático 2 - LAIG','#ff0000',0,1512864000);
INSERT INTO List VALUES(NULL,1,'Prendas','#0000ff',1,1512864000);

INSERT INTO List VALUES(NULL,0,'Futebol','#0000ff',0,1512864000);
INSERT INTO List VALUES(NULL,1,'Filmes','#0000ff',0,1512864000);

INSERT INTO List VALUES(NULL,0,'CS:GO','#0000ff',0,1512864000);
INSERT INTO List VALUES(NULL,1,'Manutenção','#0000ff',0,1512864000);

INSERT INTO List VALUES(NULL,0,'Viagens','#0000ff',0,1512864000);
INSERT INTO List VALUES(NULL,0,'Objetivos','#0000ff',0,1512864000);

-- Items
INSERT INTO Item VALUES(NULL,'Projeto LTW',0,1);
INSERT INTO Item VALUES(NULL,'Projeto LAIG',0,1);

INSERT INTO Item VALUES(NULL,'Bezier',0,2);
INSERT INTO Item VALUES(NULL,'Shaders',0,2);
INSERT INTO Item VALUES(NULL,'Interface',1,2);

INSERT INTO Item VALUES(NULL,'Pais',1,3);
INSERT INTO Item VALUES(NULL,'Irmãos',0,3);
INSERT INTO Item VALUES(NULL,'Amigos',1,3);

INSERT INTO Item VALUES(NULL,'AE Portucalense',1,4);
INSERT INTO Item VALUES(NULL,'FCUP',1,4);
INSERT INTO Item VALUES(NULL,'AEICBAS',0,4);

INSERT INTO Item VALUES(NULL,'Carros 3',0,5);
INSERT INTO Item VALUES(NULL,'Gru 3',0,5);
INSERT INTO Item VALUES(NULL,'Velocidade Furiosa 9',0,5);

INSERT INTO Item VALUES(NULL,'Mirage',0,6);
INSERT INTO Item VALUES(NULL,'Nuke',0,6);
INSERT INTO Item VALUES(NULL,'Dust II',1,6);

INSERT INTO Item VALUES(NULL,'Carro',0,7);
INSERT INTO Item VALUES(NULL,'Computador',0,7);
INSERT INTO Item VALUES(NULL,'Telemóvel',1,7);
INSERT INTO Item VALUES(NULL,'Relógio',1,7);
INSERT INTO Item VALUES(NULL,'Televisão',1,7);

INSERT INTO Item VALUES(NULL,'Brasil',1,8);
INSERT INTO Item VALUES(NULL,'Alemanha',0,8);
INSERT INTO Item VALUES(NULL,'Estados Unidos da América',1,8);
INSERT INTO Item VALUES(NULL,'Espanha',1,8);
INSERT INTO Item VALUES(NULL,'China',0,8);

INSERT INTO Item VALUES(NULL,'Segurança',0,9);
INSERT INTO Item VALUES(NULL,'JavaScript',0,9);
INSERT INTO Item VALUES(NULL,'CSS',0,9);
INSERT INTO Item VALUES(NULL,'PHP',0,9);
-- Tags
INSERT INTO Tag VALUES(NULL,'feup');
INSERT INTO Tag VALUES(NULL,'ltw');
INSERT INTO Tag VALUES(NULL,'laig');

INSERT INTO Tag VALUES(NULL,'natal');

INSERT INTO Tag VALUES(NULL,'futebol');

INSERT INTO Tag VALUES(NULL,'filmes');
INSERT INTO Tag VALUES(NULL,'carros');

INSERT INTO Tag VALUES(NULL,'csgo');
INSERT INTO Tag VALUES(NULL,'gaming');

INSERT INTO Tag VALUES(NULL,'fix');
INSERT INTO Tag VALUES(NULL,'tech');

INSERT INTO Tag VALUES(NULL,'travel');
INSERT INTO Tag VALUES(NULL,'discover');

INSERT INTO Tag VALUES(NULL,'project');
INSERT INTO Tag VALUES(NULL,'github');

-- Category
INSERT INTO Category VALUES(1,1);
INSERT INTO Category VALUES(1,2);
INSERT INTO Category VALUES(1,3);

INSERT INTO Category VALUES(2,1);
INSERT INTO Category VALUES(2,3);

INSERT INTO Category VALUES(3,4);

INSERT INTO Category VALUES(4,5);
INSERT INTO Category VALUES(4,1);

INSERT INTO Category VALUES(5,6);
INSERT INTO Category VALUES(5,7);

INSERT INTO Category VALUES(6,8);
INSERT INTO Category VALUES(6,9);

INSERT INTO Category VALUES(7,10);
INSERT INTO Category VALUES(7,11);

INSERT INTO Category VALUES(8,12);
INSERT INTO Category VALUES(8,13);

INSERT INTO Category VALUES(9,2);
INSERT INTO Category VALUES(9,1);
INSERT INTO Category VALUES(9,14);
INSERT INTO Category VALUES(9,15);


-- Belongs
INSERT INTO Belongs VALUES(1,1);
INSERT INTO Belongs VALUES(2,1);
INSERT INTO Belongs VALUES(3,1);

INSERT INTO Belongs VALUES(4,2);
INSERT INTO Belongs VALUES(5,2);

INSERT INTO Belongs VALUES(6,3);
INSERT INTO Belongs VALUES(7,3);

INSERT INTO Belongs VALUES(8,4);
INSERT INTO Belongs VALUES(9,4);

--Trigger to check List if all items are checked
CREATE TRIGGER IF NOT EXISTS LIST_CHECKED
AFTER UPDATE ON Item
FOR EACH ROW --Already default
WHEN ((new.checked = 1 AND old.checked = 0) AND
(SELECT count(Item.idItem) FROM List
  INNER JOIN Item
  ON ((new.idList = List.idList) AND (Item.idList = List.idList) AND (Item.checked = 1))) =
  (SELECT count(Item.idItem) FROM List
  INNER JOIN Item
  ON ((new.idList = List.idList) AND (Item.idList = List.idList))))
BEGIN
  UPDATE List
  SET checked = 1
  WHERE (idList = new.idList);
END;

--Trigger to uncheck List if one item is unchecked
CREATE TRIGGER IF NOT EXISTS LIST_UNCHECKED
AFTER UPDATE ON Item
FOR EACH ROW --Already default
WHEN (new.checked = 0 AND old.checked = 1)
BEGIN
  UPDATE List
  SET checked = 0
  WHERE (idList = new.idList);
END;

--Trigger to check List if one unchecked item is deleted and the rest are checked
CREATE TRIGGER IF NOT EXISTS ITEM_DELETED
AFTER DELETE ON Item
FOR EACH ROW --Already default
WHEN ((old.checked = 0) AND
  (SELECT count(Item.idItem) FROM List
  INNER JOIN Item
  ON ((old.idList = List.idList) AND (Item.idList = List.idList) AND (Item.checked = 1))) =
  (SELECT count(Item.idItem) FROM List
  INNER JOIN Item
  ON ((old.idList = List.idList) AND (Item.idList = List.idList))))
BEGIN
  UPDATE List
  SET checked = 1
  WHERE (idList = old.idList);
END;
