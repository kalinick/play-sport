# Play sport

## Setup

    sudo su;
    cd /tmp;
    if cd play-sport; then git pull; else git clone git@github.com:kalinick/play-sport.git; cd play-sport; fi;
    echo 'if install not work, please run php composer.phar update symfony/icu';
    php composer.phar install;
    rm -rf app/cache/dev;
    sudo -u www-data rsync -r /tmp/play-sport /var/www/;
    cd /var/www/play-sport;
    sudo -u www-data rm -rf .git;
    sudo -u www-data php app/console doctrine:migrations:migrate --no-interaction;
    sudo -u www-data php app/console --env='dev' cache:clear;
    sudo -u www-data php app/console --env='prod' cache:clear;
