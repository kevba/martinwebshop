WooCommerce template-overrides
==============================

Het thema past WooCommerce vooral aan via hooks (inc/woocommerce.php) en CSS
(assets/css/woocommerce.css), wat updateveilig is.

Wil je een specifiek WooCommerce-sjabloon volledig overschrijven, kopieer dan
het betreffende bestand uit:
   wp-content/plugins/woocommerce/templates/
naar deze map met hetzelfde pad, bijvoorbeeld:
   woocommerce/single-product/title.php
   woocommerce/checkout/form-checkout.php
WordPress/WooCommerce gebruikt dan automatisch jouw versie.
