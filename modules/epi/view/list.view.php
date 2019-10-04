<?php
/**
 * La vue pour lister les "EPI".
 *
 * @package   TheEPI
 * @author    Jimmy Latour <jimmy@evarisk.com>
 * @copyright 2017 Evarisk
 * @since     0.1.0
 * @version   0.7.0
 */

namespace theepi;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<?php
if ( ! empty( $epis ) ) :
	foreach ( $epis as $epi ) :
		\eoxia\View_Util::exec(
			'theepi', 'epi', 'item', array(
				'epi'    => $epi,
				'new'    => $new,
				//'task_manager' => $task_manager
			)
		);
	endforeach;
endif;
