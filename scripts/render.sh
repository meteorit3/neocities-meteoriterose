#!/bin/sh
rootdir="$HOME/Git/neocities-meteoriterose"
cd $rootdir
rm -rf render_result/*
sass site/static/css/main.scss:site/static/css/main.css
php -S localhost:8008 -t site &
php_pid=$!;
sleep 1;
wget -rkE localhost:8008 -nH -P render_result;
kill $php_pid;