cd images
find . -type f ! -iname "unknown.jpg" -delete
cd ../database
rm list.db
sqlite3 -init list.sql list.db
