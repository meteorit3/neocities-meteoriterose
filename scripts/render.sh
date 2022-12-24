#!/bin/sh
rootdir="$HOME/Git/neocities-meteoriterose"
php -S localhost:8008 -t $rootdir &
php_pid=$!;
sleep 1;
wget -rkE localhost:8008 -nH -P $rootdir/render_result;
kill $php_pid;