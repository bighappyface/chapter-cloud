# Drupal project template for Platform.sh

This project provides a starter kit for Drupal 8 multisite projects hosted on [Platform.sh](http://platform.sh). It
is very closely based on the [Drupal Composer project](https://github.com/drupal-composer/drupal-project).

It differs slightly from the standard [Drupal 8 project template](https://github.com/platformsh/platformsh-example-drupal8), in that it is setup for 2 multi-site instances, named `first` and `second`, both of which are setup to be subdomains of the same parent domain.  It can be used directly or as a reference for modifying your own project.

## Starting a new project

To start a new Drupal 8 project on Platform.sh, you have 2 options:

1. Create a new project through the Platform.sh user interface and select "start
   new project from a template".  Then select Drupal 8 as the template. That will
   create a new project using this repository as a starting point.

2. Take an existing project, add the necessary Platform.sh files, and push it
   to a Platform.sh Git repository. This template includes examples of how to
   set up a Drupal 8 site.  (See the "differences" section below.)

## Using as a reference

You can also use this repository as a reference for your own Drupal projects, and
borrow whatever code is needed.  The most important parts are the `.platform.app.yaml` file,
the `.platform` directory, and the changes made to `settings.php`.

## Managing a Drupal site built with Composer

Once the site is installed, there is no difference between a site hosted on Platform.sh
and a site hosted anywhere else.  It's just Composer.  See the [Drupal documentation](https://www.drupal.org/node/2404989)
for tips on how best to leverage Composer with Drupal 8.

## How does this starter kit differ from vanilla Drupal from Drupal.org?

1. The `vendor` directory (where non-Drupal code lives) and the `config` directory
   (used for syncing configuration from development to production) are outside
   the web root. This is a bit more secure as those files are now not web-accessible.

2. The `settings.php` and `settings.platformsh.php` files are provided by
   default. The `settings.platformsh.php` file automatically sets up the database connection on Platform.sh, and allows controlling Drupal configuration from environment variables.

3. We include recommended `.platform.app.yaml` and `.platform` files that should suffice
   for most use cases. You are free to tweak them as needed for your particular site.

## Lando Reference

You should definitely check out the [Lando docs](https://docs.devwithlando.io) for a full sweep on its capabilities but here are some helpers for this particular config. **YOU PROBABLY WANT TO LANDO START YOUR APP BEFORE YOU DO MOST OF THESE THINGS.**

Unless otherwise indicated these should all be run from your repo root (eg the directory that contains the `.lando.yml` for your site).

### Generic Ccommands

```bash
# List all available lando commands for this app
lando

# Start my site
lando start

# Stop my site
lando stop

# Restart my site
lando restart

# Get important connection info
lando info

# Other helpful things
# Rebuild all containers and build process steps
lando rebuild
# Destroy the containers and tools for this app
lando destroy
# Get info on lando service logs
lando logs
# Get a publically accessible URL. Run lando info to get the proper localhost address
lando share -u http://localhost:32813
# "SSH" into the appserver
lando ssh

# Run help to get more info
lando ssh -- --help
```

### Development commands

```bash
# Run composer things
lando composer install
lando composer update

# Run php things
lando php -v
lando php -i

# Run drush commands
# replace web if you've moved your webroot to a difference subdirectory
cd web
lando drush status
lando drush cr

# Run drupal console commands
# replace web if you've moved your webroot to a difference subdirectory
cd web
lando drupal
```

### Testing commands

```bash
# Lint code
lando phplint

# Run phpcs commands
lando phpcs
# Check drupal code standards
lando phpcs --config-set installed_paths /app/vendor/drupal/coder/coder_sniffer
lando phpcs -n --report=full --standard=Drupal --ignore=*.tpl.php --extensions=install,module,php,inc web/modules web/themes web/profiles

# Run phpunit commands
# replace web if you've moved your webroot to a difference subdirectory
cd web
lando phpunit
# Run some phpunit tests
lando phpunit -c core --testsuite unit --exclude-group Composer

# Run behat commands
lando behat
# Run some behat tests
lando behat --config=/app/tests/behat-lando.yml
```

### Platform.sh commands

```bash
# List platform commands
lando platform list

# Login to platform
lando platform login

# Import a database from master
lando platform db:dump --gzip --file=dump.sql.gz --project=PROJECT_ID --environment=master
lando db-import dump.sql.gz
rm -f dump.sql.gz
```
