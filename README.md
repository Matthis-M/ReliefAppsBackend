# ReliefAppsBackend
Test Symfony backend for Relief Applications


To setup the backend :

1 - install Symfony reqs
2 - install "libnss3-tools" (for root ca generation for CORS)
2 - install Symfony cli
3 - clone git repo
4 - composer install
5 - php bin/console doctrine:migrations:migrate
6 - symfony server:ca:install
7 - restart your browser
8 - all good
