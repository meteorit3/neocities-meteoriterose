#!/bin/sh
ROOTDIR="$HOME/Git/neocities-meteoriterose"
php -S localhost:8008 -t $ROOTDIR &
php_pid=$!;
sleep 1;
wget -rkE localhost:8008 -nH -P $ROOTDIR/render_result;
kill $php_pid;