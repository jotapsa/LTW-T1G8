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
