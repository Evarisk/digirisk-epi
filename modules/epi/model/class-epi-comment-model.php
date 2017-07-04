<?php
/**
 * Modèles des commentaires des EPI.
 *
 * @author Jimmy Latour <jimmy@evarisk.com>
 * @since 1.0.0.0
 * @version 1.0.0.0
 * @copyright 2015-2017 Evarisk
 * @package epi
 * @subpackage model
 */

namespace evarisk_epi;

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Modèles des commentaires des EPI.
 */
class EPI_Comment_Model extends \eoxia\comment_model {

	/**
	 * Le constructeur
	 *
	 * @param EPI_Comment_Class $object les données du commentaire de l'epi.
	 *
	 * @since 1.0.0.0
	 * @version 1.0.0.0
	 */
	public function __construct( $object ) {
		$this->model['state'] = array(
			'type' 			=> 'string',
			'meta_type'	=> 'field',
			'field' => '_state',
		);

		parent::__construct( $object );
	}

}
