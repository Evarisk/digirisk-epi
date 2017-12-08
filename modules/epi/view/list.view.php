<?php
/**
 * La vue principale de la page "EPI"
 *
 * @author Jimmy Latour <jimmy@evarisk.com>
 * @since 0.1.0
 * @version 0.1.0
 * @copyright 2017 Evarisk
 * @package Digirisk_EPI
 */

namespace evarisk_epi;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<?php $i = 1; ?>
<?php if ( ! empty( $epi_list ) ) : ?>
	<?php foreach ( $epi_list as $epi ) : ?>
		<?php
		\eoxia\View_Util::exec( 'digirisk-epi', 'epi', 'item', array(
			'epi' => $epi,
		) );
		?>
	<?php endforeach; ?>
<?php endif;
