cd images
find . -type f ! -iname "unknown.jpg" -delete
cd ../database
sqlite3 -init list.sql list.db
