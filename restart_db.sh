cd images
rm *
cd ../database
sqlite3 -init list.sql list.db
