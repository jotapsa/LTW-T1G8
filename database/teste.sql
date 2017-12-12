SELECT List.* FROM List,
  (SELECT List.idList as id
        FROM List INNER JOIN Category
        ON ((List.privacy = 0) AND (List.idList = Category.idList))
        INNER JOIN Tag
        ON ((Tag.idTag = Category.idTag) AND Tag.name = 'futebol')
        INNER JOIN Belongs
        ON (Belongs.idList = List.idList)
        INNER JOIN User
        ON ((User.username != 'barbosa') AND (Belongs.idUser = User.idUser))
        GROUP BY List.idList) notUser,
      (SELECT List.idList as id
        FROM List INNER JOIN Category
        ON (List.idList = Category.idList)
        INNER JOIN Tag
        ON ((Tag.idTag = Category.idTag) AND (Tag.name = 'futebol'))
        INNER JOIN Belongs
        ON (Belongs.idList = List.idList)
        INNER JOIN User
        ON ((User.username == 'barbosa') AND (Belongs.idUser = User.idUser))
        GROUP BY List.idList) sessionUser
  WHERE (List.idList = sessionUser.id OR List.idList = notUser.id)
  GROUP BY List.idList
  ORDER BY List.idList ASC;
