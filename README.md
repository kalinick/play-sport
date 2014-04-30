# Play sport

## Deploy

    sudo su;
    cd /tmp;
    if cd play-sport; then
        git pull;
    else
        git clone git@github.com:kalinick/play-sport.git;
        cd play-sport;
    fi;
    echo 'if install not work, please run php composer.phar update symfony/icu';
    php composer.phar install;
    rsync -r -v --exclude-from="/tmp/play-sport/rsync.exclude" /tmp/play-sport /var/www/;
    cd /var/www/play-sport;
    if [ ! -d app/cache ]; then
        mkdir app/cache;
        chown www-data app/cache;
        chgrp www-data app/cache;
    fi;
    if [ ! -d app/logs ]; then
        mkdir app/logs;
        chown www-data app/logs;
        chgrp www-data app/logs;
    fi;
    if [ ! -d web/uploads ]; then
        mkdir web/uploads;
        chown www-data web/uploads;
        chgrp www-data web/uploads;
    fi;
    sudo -u www-data php app/console --env='dev' cache:clear;
    sudo -u www-data php app/console doctrine:migrations:migrate --no-interaction;
    sudo -u www-data php app/console --env='dev' cache:clear;
    sudo -u www-data php app/console --env='prod' cache:clear;
