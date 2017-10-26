#!/usr/bin/env bash

TEMP_PROJECT_DIR=/tmp/project
BRANCH_NAME=$(git rev-parse --abbrev-ref HEAD)
FOLDER_NAME=src/Spolischook/Spartium
REPOSITORY_URL=git@github.com:spolischook/UploadedFileHandler.git

rm -rf $TEMP_PROJECT_DIR
cp -r ./ $TEMP_PROJECT_DIR
cd $TEMP_PROJECT_DIR

echo "Remove vendor directories"
find $TEMP_PROJECT_DIR -type d -name vendor -exec rm -rf {} \;

git filter-branch --prune-empty --subdirectory-filter $FOLDER_NAME  $BRANCH_NAME

git remote set-url origin $REPOSITORY_URL
git push -u origin $BRANCH_NAME
