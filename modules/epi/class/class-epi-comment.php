<?php
/**
 * Handle EPI Comments
 *
 * @author Jimmy Latour <jimmy@evarisk.com>
 * @since 0.1.0
 * @version 0.2.0
 * @copyright 2015-2017 Evarisk
 * @package TheEPI
 */

namespace theepi;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle EPI Comments
 */
class EPI_Comment_Class extends \eoxia\Comment_Class {

	/**
	 * Le nom du modèle
	 *
	 * @var string
	 */
	protected $model_name = '\theepi\EPI_Comment_Model';

	/**
	 * La clé principale du modèle
	 *
	 * @var string
	 */
	protected $meta_key = '_theepi_epi_comment';

	/**
	 * Le type
	 *
	 * @var string
	 */
	protected $comment_type = 'theepi-epi-comment';

	/**
	 * La route pour accéder à l'objet dans la rest API
	 *
	 * @var string
	 */
	protected $base = 'theepi/epi-comment';

	/**
	 * La version de l'objet
	 *
	 * @var string
	 */
	protected $version = '0.1';

	/**
	 * La fonction appelée automatiquement avant la création de l'objet dans la base de donnée
	 *
	 * @var array
	 */
	protected $before_post_function = array( '\theepi\update_control_date' );

	/**
	 * La fonction appelée automatiquement avant la sauvegarde de l'objet dans la base de donnée
	 *
	 * @var array
	 */
	protected $before_put_function = array( '\theepi\update_control_date' );

	/**
	 * Récupères les commentaires puis appelle la vue list-view.view.php
	 *
	 * @since 0.1.0
	 * @version 0.2.0
	 *
	 * @param  EPI_Model $epi Les données de l'EPI.
	 *
	 * @return void
	 */
	public function display( $epi ) {
		$comments = self::g()->get( array(
			'post_id' => $epi->id,
			'status'  => -34070,
			'orderby' => 'comment_ID',
			'order'   => 'ASC',
		) );

		$userdata = get_userdata( get_current_user_id() );

		\eoxia\View_Util::exec( 'theepi', 'epi', 'comment/list-view', array(
			'epi'      => $epi,
			'comments' => $comments,
			'userdata' => $userdata,
		) );
	}

	/**
	 * Affiches la vue pour éditer un commentaires
	 *
	 * @since 0.1.0
	 * @version 0.2.0
	 *
	 * @param  EPI_Model $epi Les données de l'EPI.
	 *
	 * @return void
	 */
	public function display_edit( $epi ) {
		$comments = array();

		if ( 0 !== $epi->id ) {
			$comments = self::g()->get( array(
				'post_id' => $epi->id,
				'status'  => -34070,
				'orderby' => 'comment_ID',
				'order'   => 'ASC',
			) );
		}

		$comment_schema = self::g()->get( array(
			'schema' => true,
		) );

		$comment_schema = $comment_schema[0];

		$userdata = get_userdata( get_current_user_id() );

		\eoxia\View_Util::exec( 'theepi', 'epi', 'comment/list-edit', array(
			'epi'            => $epi,
			'comments'       => $comments,
			'comment_schema' => $comment_schema,
			'userdata'       => $userdata,
		) );
	}

	/**
	 * Sauvegardes les commentaires de l'EPI.
	 *
	 * @param  integer $epi_id L'ID de l'EPI.
	 * @param  array   $data   Les données des commentaires.
	 *
	 * @return boolean
	 *
	 * @since 0.1.0
	 * @version 0.1.0
	 */
	public function save_comments( $epi_id, $data ) {
		if ( isset( $epi_id ) ) {
			if ( ! empty( $data ) ) {
				foreach ( $data as $comment ) {
					if ( isset( $comment['content'] ) ) {
						$comment['post_id'] = $epi_id;
						self::g()->update( $comment );
					}
				}
			}
		}

		return true;
	}
}

EPI_Comment_Class::g();
