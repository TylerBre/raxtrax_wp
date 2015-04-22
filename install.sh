mkdir -p wp
git clone https://github.com/WordPress/WordPress.git wp
rm -rf wp/wp-content/plugins wp/wp-content/themes wp/wp-content/mu-plugins wp/wp-config.php wp/.htaccess
ln -s "$(pwd)/plugins" "wp/wp-content/plugins"
ln -s "$(pwd)/themes" "wp/wp-content/themes"
ln -s "$(pwd)/uploads" "wp/wp-content/uploads"
ln -s "$(pwd)/wp-config.php" "wp/wp-config.php"
ln -s "$(pwd)/.htaccess" "wp/.htaccess"
