<?php
/**
 * Gestion des onglets dans la page "theepi-setting".
 *
 * @package   TheEPI
 * @author    Jimmy Latour <jimmy@evarisk.com>
 * @copyright 2015-2017 Evarisk
 * @since     0.2.0
 * @version   0.5.0
 */

namespace theepi;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="wpeo-tab setting">
	<h1><?php esc_html_e( 'TheEPI settings', 'theepi' ); ?></h1>

	<ul class="tab-list tab-redirect">
		<li class="tab-element <?php echo $page == "capability" ? 'tab-active' : ''; ?>" data-tab="capability" data-url="<?php echo esc_attr( admin_url( 'options-general.php?page=theepi-setting&tab=capability' ) ); ?>"> <?php esc_html_e( 'Capability', 'theepi' ); ?></li>
		<li class="tab-element <?php echo $page == "default-data" ? 'tab-active' : ''; ?>" data-tab="default-data" data-url="<?php echo esc_attr( admin_url( 'options-general.php?page=theepi-setting&tab=default-data' ) ); ?>"> <?php esc_html_e( 'Default Data', 'theepi' ); ?> </li>
		<li class="tab-element <?php echo $page == "date-management" ? 'tab-active' : ''; ?>" data-tab="date-management" data-url="<?php echo esc_attr( admin_url( 'options-general.php?page=theepi-setting&tab=date-management' ) ); ?>"> <?php esc_html_e( 'Date Management', 'theepi' ); ?> </li>
	</ul>



	<div class="digirisk-wrap">

		<div class="tab-content <?php echo $page == "capability" ? '' : 'hidden'; ?>">
			<?php \eoxia\View_Util::exec( 'theepi', 'setting', 'capability/main' ); ?>
		</div>

		<div class="tab-content <?php echo $page == "default-data" ? '' : 'hidden'; ?>">
			<?php
			\eoxia\View_Util::exec(
				'theepi', 'setting', 'default-data/main', array(
					'default_periodicity'      => $default_periodicity,
					'default_lifetime'         => $default_lifetime
				)
			);
			?>
		</div>

		<div class="tab-content <?php echo $page == "date-management" ? '' : 'hidden'; ?>">

			<?php
			\eoxia\View_Util::exec(
				'theepi', 'setting', 'date-management/main' , array(
					'default_purchase_date'    => $default_purchase_date,
					'default_manufacture_date' => $default_manufacture_date
				)
			);
			?>
		</div>
	</div>
</div>
