SELECT List.* FROM List,
  (SELECT List.idList as id
        FROM List INNER JOIN Category
        ON ((List.privacy = 0) AND (List.idList = Category.idList))
        INNER JOIN Tag
        ON ((Tag.idTag = Category.idTag) AND Tag.name = 'feup')
        INNER JOIN User
        ON ((User.username != 'john') AND (User.idUser = List.idUser))
        GROUP BY List.idList) notUser,
      (SELECT List.idList as id
        FROM List INNER JOIN Category
        ON (List.idList = Category.idList)
        INNER JOIN Tag
        ON ((Tag.idTag = Category.idTag) AND (Tag.name = 'feup'))
        INNER JOIN User
        ON ((User.username = 'john') AND (User.idUser = List.idUser))
        GROUP BY List.idList) sessionUser
  WHERE (List.idList = sessionUser.id OR List.idList = notUser.id)
  GROUP BY List.idList
  ORDER BY List.idList ASC;
