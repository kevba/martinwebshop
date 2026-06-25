<?php
/**
 * Header template.
 *
 * @package Geloofstegels
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Ga naar inhoud', 'geloofstegels' ); ?></a>

<header id="masthead" class="site-header">
	<div class="gt-container">
		<div class="site-header__bar">

			<div class="site-branding">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else {
					if ( is_front_page() && is_home() ) {
						echo '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></h1>';
					} else {
						echo '<p class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></p>';
					}
					$gt_description = get_bloginfo( 'description', 'display' );
					if ( $gt_description ) {
						echo '<p class="site-description">' . esc_html( $gt_description ) . '</p>';
					}
				}
				?>
			</div>

			<div class="header-actions">
				<button class="gt-icon gt-search-toggle" aria-label="<?php esc_attr_e( 'Zoeken openen', 'geloofstegels' ); ?>" aria-expanded="false">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
				</button>

				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<a class="gt-icon" href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" aria-label="<?php esc_attr_e( 'Mijn account', 'geloofstegels' ); ?>">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg>
					</a>
					<a class="gt-icon header-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php esc_attr_e( 'Winkelmand', 'geloofstegels' ); ?>">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.7 13.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L23 6H6"/></svg>
						<span class="header-cart__count"><?php echo esc_html( WC()->cart ? WC()->cart->get_cart_contents_count() : 0 ); ?></span>
					</a>
				<?php endif; ?>

				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Menu openen', 'geloofstegels' ); ?>">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
				</button>
			</div>
		</div>
	</div>

	<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Hoofdmenu', 'geloofstegels' ); ?>">
		<div class="gt-container">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'menu_class'     => 'menu',
						'walker'         => new Geloofstegels_Walker_Nav_Menu(),
					)
				);
			} else {
				echo '<ul class="menu"><li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Stel het hoofdmenu in', 'geloofstegels' ) . '</a></li></ul>';
			}
			?>
		</div>
	</nav>
</header>

<?php
// Zoek-overlay.
?>
<div class="gt-search-overlay" id="gt-search-overlay">
	<button class="gt-search-overlay__close" aria-label="<?php esc_attr_e( 'Sluiten', 'geloofstegels' ); ?>">&times;</button>
	<div class="gt-search-overlay__inner">
		<?php get_search_form(); ?>
		<p class="gt-search-overlay__hint"><?php esc_html_e( 'Zoek op productnaam, moment of bijbeltekst (bijv. "Jozua 1:9")', 'geloofstegels' ); ?></p>
	</div>
</div>

<div id="content" class="site-content">
