--Trigger to check List if all items are checked
CREATE TRIGGER IF NOT EXISTS LIST_UNCHECKED
AFTER UPDATE ON Item
FOR EACH ROW --Already default
WHEN ((new.checked = 0 AND old.checked = 1) AND
(SELECT count(Item.idItem) FROM List
  INNER JOIN Item
  ON ((new.idList = List.idList) AND (Item.idList = List.idList) AND (Item.checked = 1))) <
  (SELECT count(Item.idItem) FROM List
  INNER JOIN Item
  ON ((new.idList = List.idList) AND (Item.idList = List.idList))))
BEGIN
  UPDATE List
  SET checked = 0
  WHERE (idList = new.idList);
END;
