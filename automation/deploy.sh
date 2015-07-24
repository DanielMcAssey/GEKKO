#!/bin/sh

VAR_ENVDIR="/home/glokon/domains/dcm.li/root.dcm/env.root/"
VAR_PUBLISHDIR="/home/glokon/domains/dcm.li/root.dcm/app.root/"
VAR_VERSION_INFO="$BUILD_NUMBER-$GIT_BRANCH-$GIT_COMMIT"
VAR_GIT_BRANCH="master"

ssh -p 1995 glokon@198.187.30.65 <<EOF
  cd $VAR_PUBLISHDIR
  php artisan down
  git pull origin ${VAR_GIT_BRANCH}
  cp ${VAR_ENVDIR}.env.php $VAR_PUBLISHDIR
  touch -m ${VAR_PUBLISHDIR}app/.version
  find . -type d -exec chmod 755 {} \;
  find . -type f -exec chmod 644 {} \;
  cat /dev/null > ${VAR_PUBLISHDIR}app/.version
  echo $VAR_VERSION_INFO > ${VAR_PUBLISHDIR}app/.version
  composer install --no-dev --optimize-autoloader
  php artisan migrate --force
  php artisan up
  exit
EOF