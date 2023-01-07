#!/bin/sh
rootdir="$HOME/Git/neocities-meteoriterose"

sleep 0.1
echo "enter 8ody file path, or press enter to create a new one"
read body_path
if [ "$body_path" = "" ]; then
    rm -rf /tmp/post.html*
    nvim -n /tmp/post.html
    body_path="/tmp/post.html"
fi
echo "enter title:"
read title
echo "enter tags:"
read tags
echo "enter image paths (or \"none\")"
read image_paths
echo "enter thum8nail image path (or \"none\"):"
read thumbnail_path
echo "Priv8 or Pu8lic (0 or 1)"
read published

php "$rootdir"/site/posting.php "$title" "$tags" "$image_paths" "$thumbnail_path" "$body_path" "$published"
