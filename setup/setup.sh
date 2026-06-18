#!/bin/sh
set -e

echo "Waiting for database to be ready..."
until wp db check 2>/dev/null; do
  sleep 3
done

echo "Waiting for WordPress files..."
until [ -f /var/www/html/wp-includes/version.php ]; do
  sleep 3
done

# Only run setup if WordPress is not yet installed
if ! wp core is-installed 2>/dev/null; then
  echo "Installing WordPress..."
  wp core install \
    --url="${WP_URL}" \
    --title="${WP_TITLE}" \
    --admin_user="${WP_ADMIN_USER}" \
    --admin_password="${WP_ADMIN_PASSWORD}" \
    --admin_email="${WP_ADMIN_EMAIL}"
else
  echo "WordPress already installed, skipping core install."
fi

# --- Plugins ---
# WooCommerce
if ! wp plugin is-installed woocommerce 2>/dev/null; then
  echo "Installing WooCommerce..."
  wp plugin install woocommerce --activate
else
  wp plugin activate woocommerce 2>/dev/null || true
  echo "WooCommerce already installed."
fi

# Limit login attempts
if ! wp plugin is-installed limit-login-attempts-reloaded 2>/dev/null; then
  echo "Installing Limit Login Attempts..."
  wp plugin install limit-login-attempts-reloaded --activate
else
  wp plugin activate limit-login-attempts-reloaded 2>/dev/null || true
fi

# Disable XML-RPC (common attack vector)
if ! wp plugin is-installed disable-xml-rpc 2>/dev/null; then
  echo "Installing Disable XML-RPC..."
  wp plugin install disable-xml-rpc --activate
else
  wp plugin activate disable-xml-rpc 2>/dev/null || true
fi

# Add more plugins here:
# wp plugin install plugin-name --activate

# --- Theme ---
# Install parent theme (Flavor)
if ! wp theme is-installed flavor 2>/dev/null; then
  echo "Installing Flavor parent theme..."
  wp theme install flavor
fi

# Activate child theme
wp theme activate martin-theme

# --- WooCommerce settings ---
wp option update woocommerce_currency EUR
wp option update woocommerce_store_address "Your Street 1"
wp option update woocommerce_store_city "Your City"
wp option update woocommerce_store_postcode "1234AB"
wp option update woocommerce_default_country "NL"

# Create WooCommerce pages (shop, cart, checkout, my-account)
wp wc tool run install_pages --user="${WP_ADMIN_USER}" 2>/dev/null || true

# --- Security hardening ---
wp config set DISALLOW_FILE_EDIT true --raw

echo "Setup complete!"
