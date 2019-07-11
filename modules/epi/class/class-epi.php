<?php
/**
* Handle EPI.
*
* @author Jimmy Latour <jimmy@evarisk.com> && Nicolas Domenech <nicolas@eoxia.com>
* @since 0.1.0
* @version 0.5.0
* @copyright 2018 Evarisk
* @package TheEPI
*/

namespace theepi;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Handle EPI
*/
class EPI_Class extends \eoxia\Post_Class {

	/**
	* Le nom du modèle
	*
	* @var string
	*/
	protected $model_name = '\theepi\EPI_Model';

	/**
	* Le post type
	*
	* @var string
	*/
	protected $type = 'theepi-epi';

	/**
	* La clé principale du modèle
	*
	* @var string
	*/
	protected $meta_key = '_theepi_epi';

	/**
	* La route pour accéder à l'objet dans la rest API
	*
	* @var string
	*/
	protected $base = 'theepi/epi';

	/**
	* La version de l'objet
	*
	* @var string
	*/
	protected $version = '0.1';

	/**
	* Le préfixe de l'objet dans TheEPI.
	*
	* @var string
	*/
	public $element_prefix = 'EPI';

	/**
	* La limite des EPI a affiché par page
	*
	* @var integer
	*/
	protected $limit_epi = 10;

	/**
	* L'option pour enregistrer le commentaire par défault.
	*
	* @var string
	*/
	public $option_name_per_page = 'epi_per_page';

	/**
	* Le nom pour le register post type
	*
	* @var string
	*/
	protected $post_type_name = 'Personal protective equipment';

	/**
	* La taxonomie à attacher.
	*
	* @var string
	*/
	protected $attached_taxonomy_type = '_theepi_state';

	/**
	* Appel la vue principale pour afficher le tableau HTML contenant les EPI.
	*
	* @since 0.2.0
	* @version 0.5.0
	*
	* @param string $term Terme de la recherche. Défault ''.
	*
	* @return void
	*/
	public function display( $term = '' ) {
		$epi_schema = self::g()->get( array(
			'schema' => true,
		), true );

		$pagination_data = $this->get_pagination_data( 0, $term );

		$epis = $this->get_epis( $pagination_data, $term );

		\eoxia\View_Util::exec( 'theepi', 'epi', 'main', array(
			'offset'     => $pagination_data['offset'],
			'count_epi'  => $pagination_data['count_epi'],
			'per_page'   => $pagination_data['per_page'],
			'epis'       => $epis,
			'epi_schema' => $epi_schema,
			'term'       => $term,
		) );
	}

	/**
	* Récupères la liste des EPI.
	*
	* @since 0.4.0
	* @version 0.4.0
	*
	* @param array  $data (Voir au dessus.).
	* @param string $term Terme de la recherche. Défault ''.
	*
	* @return array       Les EPI.
	*/
	public function get_epis( $data, $term = '' ) {
		$args = array(
			'offset'         => $data['offset'],
			'posts_per_page' => $data['per_page'],
			's'              => $term,
		);

		$epis = self::g()->get( $args );
		return $epis;
	}

	/**
	* Appel la vue pour afficher le formulaire de recherche.
	*
	* @since 0.4.0
	* @version 0.4.0
	*
	* @return void
	*/
	public function display_search() {
		\eoxia\View_Util::exec( 'theepi', 'epi', 'search' );
	}

	/**
	* Récupères les données liée à la pagination des EPI.
	*
	* @since 0.4.0
	* @version 0.4.0
	*
	* @param integer $offset       Le nombre de post à sauté. Défault 0.
	* @param string  $term         Terme de la recherche. Défault ''.
	*
	* ['count_epi']    integer Le nombre d'EPI en base de donnée.
	* ['per_page']     integer Le nombre d'EPI par page.
	* ['offset']       integer Le nombre d'EPI à sauter.
	*
	* @return array (Voir au dessus.)
	*/
	public function get_pagination_data( $offset = 0, $term = '' ) {

		$count_epi = count( self::g()->get( array(
			'fields' => array( 'ID' ),
			's'      => $term,
		) ) );

		$per_page = get_user_meta( get_current_user_id(), $this->option_name_per_page, true );

		if ( empty( $per_page ) || $per_page < 1 ) {
			$per_page = $this->limit_epi;
		}

		if ( $count_epi < $per_page ) {
			$per_page = $count_epi;
		}

		return array(
			'offset'    => $offset,
			'count_epi' => $count_epi,
			'per_page'  => $per_page,
		);
	}

	/**
	* Initialise les options d'écrans.
	*
	* @since 0.2.0
	* @version 0.3.0
	*
	* @return void
	*/
	public function callback_add_screen_option() {
		add_screen_option(
			'per_page',
			array(
				'label'   => __( 'EPI per page', 'theepi' ),
				'default' => self::g()->limit_epi,
				'option'  => self::g()->option_name_per_page,
			)
		);
	}

	/**
	* Affiches la liste des EPI
	*
	* @since 0.1.0
	* @version 0.4.0
	*
	* @param array $epis La liste des EPI.
	*
	* @return void
	*/
	public function display_epi_list( $epis, $new = false ) {
		\eoxia\View_Util::exec( 'theepi', 'epi', 'list', array(
			'epis' => $epis,
			'new'  => $new,
		) );
	}

	/**
	* Enregistres un EPI.
	*
	* @since 0.3.0
	* @version 0.3.0
	*
	* @param  EPI_Model $epi      Les données de l'EPI.
	* @param  integer   $image_id L'ID de l'image téléversé.
	*
	* ['post_id'] integer L'ID de l'EPI. (Ce n'est pas un doublon avec $data['id']).
	* ['id']      integer L'ID du commentaire.
	* ['date']    string  La date du commentaire au format MySQL.
	* ['content'] string  Le contenu du commentaire.
	* ['state']   string  Le status de l'EPI. Peut être OK ou KO.
	* @param  array     $comments (See above).
	*
	* @return EPI_Model Retourne l'objet EPI créé ou mise à jour.
	*/
	public function save( $epi, $image_id, $comments ) {
		$epi = self::g()->update( $epi->data );
		\eoxia\LOG_Util::g()->log( sprintf( 'Update EPI "%d" with the data %s', $epi->data['id'], wp_json_encode( $epi->data ) ), 'theepi' );

		if ( ! empty( $image_id ) ) {
			$args_media = array(
				'id'         => $epi->data['id'],
				'file_id'    => $image_id,
				'model_name' => '\theepi\EPI_Class',
			);

			\eoxia\WPEO_Upload_Class::g()->set_thumbnail( $args_media );
			$args_media['field_name'] = 'image';
			\eoxia\WPEO_Upload_Class::g()->associate_file( $args_media );

			\eoxia\LOG_Util::g()->log( sprintf( 'Add media on EPI "%d", media ID "%d"', $epi->data['id'], $image_id ), 'theepi' );
		}

		//EPI_Comment_Class::g()->save_comments( $epi->data['id'], $comments );

		// Obliger de get à nouveau pour récupérer control_date, et state.
		$epi = self::get( array( 'id' => $epi->data['id'] ), true );

		return $epi;
	}

	/**
	* Supprimes un EPI.
	*
	* @since 0.3.0
	* @version 0.4.0
	*
	* @param  integer $id L'ID de l'EPI.
	*
	* @return bool        True si tout s'est bien passé.
	*/
	public function delete( $id ) {
		$epi = self::g()->get( array(
			'id' => $id,
		), true );

		$epi->data['status'] = 'trash';

		self::g()->update( $epi->data );
		\eoxia\LOG_Util::g()->log( sprintf( ' EPI "%d" is now trashed, EPI data %s', $epi->data['id'], wp_json_encode( $epi ) ), 'theepi' );

		return true;
	}

	/**
	* Pour chaque ID de fichier reçu, créer un EPI.
	*
	* @since 0.3.0
	* @version 0.4.0
	*
	* @param array $files_id Un tableau d'ID.
	*
	* @return bool           True si tout s'est bien passé.
	*/
	public function create_mass_epi( array $files_id ) {
		$epis = array();

		if ( ! empty( $files_id ) ) {
			foreach ( $files_id as $file_id ) {
				$file_id = (int) $file_id;
				$epi     = self::g()->create( array( 'frequency_control' => 0 ) );

				\eoxia\WPEO_Upload_Class::g()->set_thumbnail( array(
					'id'         => $epi->data['id'],
					'file_id'    => $file_id,
					'model_name' => '\theepi\EPI_Class',
				) );

				\eoxia\WPEO_Upload_Class::g()->associate_file( array(
					'id'         => $epi->data['id'],
					'file_id'    => $file_id,
					'model_name' => '\theepi\EPI_Class',
					'field_name' => 'image',
				) );

				$epis[] = $epi;

				\eoxia\LOG_Util::g()->log( sprintf( 'Create EPI "%d" from media id "%d", saved EPI %s', $epi->data['id'], $file_id, wp_json_encode( $epi->data ) ), 'theepi' );
			}
		}

		return $epis;
	}

	public function get_days( $epi ) {
		$date_duration = 0;
		$day_rest = 0;
		if ($epi->data['periodicity'] > 0) {
			$date_duration = $epi->data['periodicity']*24*3600;
		}

		//echo '<pre>'; print_r( strtotime( 'now' ) ); echo '</pre>';

		$date_start_epi = strtotime( $epi->data[ 'date' ][ 'rendered' ][ 'mysql' ]  );
		$date_end = $date_start_epi + $date_duration;

		$time = $date_end - strtotime( 'now' ); // seconde

//echo '<pre>'; print_r( $time ); echo '</pre>'; exit;
		if( $time > 0 ) {
			$day_rest = floor( (($time /24) / 3600) );
			return $day_rest;

		} else {
			$day_rest = floor( (($time /24) / 3600) );
			return $day_rest;
		}
	}

}



EPI_Class::g();
