# ReliefAppsBackend
Symfony backend application exposing services for the following [Angular applications](https://github.com/Matthis-M/ReliefAppsFrontend)

## Setting up the Symfony application :
If Symfony CLI is already installed and the requirements met, you can skip to step 6.

1. Install PHP 7.4
  * Install a few required librairies first `sudo apt -y install lsb-release apt-transport-https ca-certificates`
  * Get the GPG key for Sury PHP repository `sudo wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg`
  * Add the Sury repository to the sources file `echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/php.list`
  * Update the sources list `sudo apt update`
  * Install PHP7.4 from the new source```sudo apt -y install php7.4```
  
2. Install composer
  * Install a few required librairies first `sudo apt install curl php-cli php-mbstring unzip`
  * Fetch the installer `curl -sS https://getcomposer.org/installer -o composer-setup.php`
  * Start the installer `sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer`
  * Update composer with `composer update`

3. Install Symfony CLI
 * Download the Symfony CLI binary with `wget https://get.symfony.com/cli/installer -O - | bash`
 * If you want to install it globally, add it to your PATH or move it to `/usr/local/bin/`. Pay attention to giving the right permissions for executing it

4. Install libnss3-tools with `sudo apt-get install libnss3-tools`
  >This tool will be used by symfony CLI to generate a root certificate to enable TLS on localhost

5. Install the SQLite PDO driver with `sudo apt-get install php7.4-sqlite3`

6. Clone this Git repository with the [following link](https://github.com/Matthis-M/ReliefAppsBackend.git)

7. Go inside the project folder and run `composer install` to install all the needed dependencies

8. Check that your system now includes all Symfony requirements by using `symfony check:requirement` and install the missing ones

9. Use `php bin/console doctrine:migrations:migrate` to setup the SQLite database

10. Run `symfony server:ca:install` to install a root certificate and prevent CORS issues
  >If there still are CORS issues, it's possible that an outdated root certificate is already installed. In that case, run `symfony server:ca:install --force`

11. If your browser was open during the process, restart it for the changes to take effect

12. You should be all set up to run the application ! You can use `symfony server:start` to do so
  >Pay attention to let it run on the default port (:8000). If not, this will prevent the Angular application to work properly

