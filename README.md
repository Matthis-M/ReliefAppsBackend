## ReliefAppsBackend
Symfony backend application exposing services for the following [Angular applications](https://github.com/Matthis-M/ReliefAppsFrontend)


## Setting up the Symfony application :

1. Install Symfony CLI
2. Check that your system includes the symfony requirements by using ```symfony check:requirement``` and install the missing ones 
3. Install "libnss3-tools"
  >This tool will be used by symfony CLI to generate a root certificate for localhost
4. Clone this Git repository
5. Go inside the repository folder and run ```composer install``` to get all the needed dependencies
6. Use ```php bin/console doctrine:migrations:migrate``` to setup the SQLite database's tables
7. Run ```symfony server:ca:install``` to install a root certificate and avoid CORS issues
  >If there are still CORS issues, it's possible that an outdated root certificate is already installed. In that case, run ```symfony server:ca:install --force```
8. If your browser was open during the process, restart it for the changes to take effect
9. You should be all set up to run the application ! You can use ```symfony server:start``` to do so. Don't hesitate to reach me if you have any problem.
