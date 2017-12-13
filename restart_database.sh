cd images
find . -type f -not -name 'unknown.jpg' -not -name 'barbosa.jpg' -not -name 'jotapsa.png' -not -name 'arthur.jpg' -not -name 'logo_feup.png' -delete
cd ../database
rm list.db
sqlite3 -init list.sql list.db
