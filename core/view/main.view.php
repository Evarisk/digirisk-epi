<?php
/**
 * La vue principale de la page "EPI"
 *
 * @author Jimmy Latour <jimmy@evarisk.com>
 * @since 0.1.0
 * @version 0.2.0
 * @copyright 2017 Evarisk
 * @package TheEPI
 */

namespace theepi;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="wrap digirisk-wrap digirisk-epi">

	<h1><?php esc_html_e( 'TheEPI', 'theepi' ); ?></h1>
	<a href="#" class="create-mass-epi"><?php esc_html_e( 'Create mass from image', 'theepi' ); ?></a>

	<div class="container-content">
		<?php EPI_Class::g()->display(); ?>
	</div>
</div>
