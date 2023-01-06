#!/bin/sh
rootdir="$HOME/Git/neocities-meteoriterose"
cd $rootdir
rm -rf public/*
sass site/static/css/main.scss:site/static/css/main.css
php -S localhost:8008 -t site &
php_pid=$!;
sleep 0.1;
wget -rkE localhost:8008 -nH -P public;
kill $php_pid;
neocities push public