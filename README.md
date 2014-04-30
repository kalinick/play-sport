# Play sport

## Setup

    sudo su;
    cd /tmp;
    if cd play-sport; then git pull; else git clone git@github.com:kalinick/play-sport.git; cd play-sport; fi;
    echo 'if install not work, please run php composer.phar update symfony/icu';
    php composer.phar install;
    rm -rf app/cache/dev;
    rsync -r -v --exclude-from="/tmp/play-sport/rsync.exclude" /tmp/play-sport /var/www/;
    cd /var/www/play-sport;
    chown www-data app/cache
    chgrp www-data app/cache
    chown www-data app/logs
    chgrp www-data app/logs
    sudo -u www-data mkdir -p web/upload
    sudo -u www-data php app/console doctrine:migrations:migrate --no-interaction;
    sudo -u www-data php app/console --env='dev' cache:clear;
    sudo -u www-data php app/console --env='prod' cache:clear;
