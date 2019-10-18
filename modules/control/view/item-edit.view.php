<?php
/**
 * La vue Edition du module Control.
 *
 * @package   TheEPI
 * @author    Evarisk <dev@evarisk.com>
 * @copyright 2019 Evarisk
 * @since     0.1.0
 * @version   0.6.0
 */

namespace theepi;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="table-row epi-control-row edit wpeo-form" data-id="<?php echo esc_attr( $control->data['id'] ); ?>">
	<input type="hidden" name="parent-id" value="<?php echo esc_attr( $epi->data['id'] ); ?>">
	<div class="table-cell table-75" data-title="<?php echo esc_attr_e( 'ID', 'theepi' ); ?>">
		<i class="fas fa-hashtag"></i> <?php echo esc_attr( $control->data['id'] ); ?>
	</div>

	<div class="table-cell table-75" data-title="<?php echo esc_attr_e( 'Avatar', 'theepi' ); ?>">
		<?php echo do_shortcode( '[theepi_avatar ids="' . $control->data['author_id'] . '" size="40"]' ); ?>
	</div>

	<div class="table-cell table-125" data-title="<?php echo esc_attr_e( 'Date', 'theepi' ); ?>">
		<i class="fas fa-calendar-alt"></i> <?php echo esc_attr( $control->data['date']['rendered']['date'] ); ?>
	</div>

	<div class="table-cell" data-title="<?php echo esc_attr_e( 'Comment', 'theepi' ); ?>">
		<div class="form-element">
			<label class="form-field-container">
				<input type="text" class="form-field" name="comment" value="<?php echo esc_attr( $control->data['comment'] ); ?>"/>
			</label>
		</div>
	</div>

	<div class="table-cell table-200" data-title="<?php echo esc_attr_e( 'URL', 'theepi' ); ?>">
		<div class="form-element">
			<label class="form-field-container">
				<input type="text" class="form-field" name="url" value="<?php echo esc_attr( $control->data['url'] ); ?>"/>
			</label>
		</div>
	</div>

	<div class="table-cell table-75" data-title="<?php echo esc_attr_e( 'Attached File', 'theepi' ); ?>">
			<?php echo do_shortcode( '[wpeo_upload id="' . $control->data['id'] . '" model_name="/theepi/Control_Class" single="false" mime_type="" display_type="list" field_name="media"]' ); ?>
	</div>

	<div class="table-cell table-75 table-status-control" data-title="<?php echo esc_attr_e( 'Status', 'theepi' ); ?>">
		<div class="wpeo-dropdown dropdown-status dropdown-right dropdown-grid dropdown-padding-0 ">
			<div class="dropdown-toggle wpeo-button button-square-50 epi-status-icon <?php echo esc_attr( $control->data['status_control'] ); ?> fas"></div>
			<input type="hidden" name="status-control" value="">
			<ul class="dropdown-content wpeo-grid grid-4">
				<li class="dropdown-item wpeo-tooltip-event epi-status-icon fas OK" aria-label="<?php esc_html_e( 'Status OK', 'theepi' ); ?>" data-status="OK"></li>
				<li class="dropdown-item wpeo-tooltip-event epi-status-icon fas KO" aria-label="<?php esc_html_e( 'Status KO', 'theepi' ); ?>" data-status="KO"></li>
				<li class="dropdown-item wpeo-tooltip-event epi-status-icon fas repair" aria-label="<?php esc_html_e( 'Status Repair', 'theepi' ); ?>" data-status="repair"></li>
				<li class="dropdown-item wpeo-tooltip-event epi-status-icon fas trash" aria-label="<?php esc_html_e( 'Status Trash', 'theepi' ); ?>" data-status="trash"></li>
			</ul>
		</div>
	</div>

	<div class="table-cell table-125 table-end action-end" data-title="<?php esc_attr_e( 'Actions', 'theepi' ); ?>">
		<div class="wpeo-button wpeo-tooltip-event button-green button-progress button-square-50 edit action-input"
			aria-label="<?php esc_html_e( 'Save Control', 'theepi' ); ?>"
			data-parent="epi-control-row"
			data-id="<?php echo esc_attr( $control->data['id'] ); ?>"
			data-action="save_control_epi"
			data-nonce="<?php echo esc_attr( wp_create_nonce( 'save_control_epi' ) ); ?>">
			<span class="button-icon fas fa-save"></span>
		</div>

		<div class="wpeo-button wpeo-tooltip-event button-grey button-square-50 action-attribute"
			aria-label="<?php esc_html_e( 'Cancel Control', 'theepi' ); ?>"
			data-id="<?php echo esc_attr( $control->data['id'] ); ?>"
			data-action="cancel_edit_control_epi"
			data-nonce="<?php echo esc_attr( wp_create_nonce( 'cancel_edit_control_epi' ) ); ?>">
			<i class="fas fa-times"></i>
	  </div>
	</div>
</div>
