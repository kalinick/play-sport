cd /tmp;
if cd play-sport; then git pull; else git clone git@github.com:kalinick/play-sport.git; cd play-sport; fi;
php composer.phar install
su www-data;
rsync -r /tmp/play-sport /var/www/;
cd /var/www/play-sport;
rm -rf .git;
php app/console --env='dev' cache:clear;
php app/console --env='prod' cache:clear;
php app/console doctrine:migrations:migrate --no-interaction;
