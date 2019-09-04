<?php
/**
 * La vue service d'un EPI.
 *
 * @package   TheEPI
 * @author    Nicolas Domenech <nicolas@eoxia.com>
 * @copyright 2019 Evarisk
 * @since     0.6.0
 * @version   0.6.0
 */

namespace theepi;

if (! defined('ABSPATH') ) {
    exit;
} ?>

<fieldset class="epi-row service" data-id="<?php echo esc_attr( $epi->data[ 'id' ] ); ?>">
	<legend>
		<?php esc_html_e( 'Commissioning', 'theepi' ); ?>
	</legend>
	<form class="wpeo-grid grid-3 grid-padding-1 wpeo-form">
		<div>
			<div class="form-element">
				<span class="form-label"><?php esc_html_e( 'Maker', 'theepi' ); ?></span>
				<label class="form-field-container">
					<span class="form-field-icon-prev"><i class="fas fa-user"></i></span>
					<input type="text" class="form-field" name="maker" value="<?php echo esc_attr( $epi->data['maker'] ) ?>"/>
				</label>
			</div>
		</div>

		<div>
			<div class="form-element">
				<span class="form-label"><?php esc_html_e( 'Seller', 'theepi' ); ?></span>
				<label class="form-field-container">
					<span class="form-field-icon-prev"><i class="fas fa-user"></i></span>
					<input type="text" class="form-field" name="seller" value="<?php echo esc_attr( $epi->data['seller'] ); ?>"/>
				</label>
			</div>
		</div>

		<div>
			<div class="form-element">
				<span class="form-label"><?php esc_html_e( 'Manager', 'theepi' ); ?></span>
				<label class="form-field-container">
					<span class="form-field-icon-prev"><i class="fas fa-user"></i></span>
					<input type="text" class="form-field" name="manager" value="<?php echo esc_attr( $epi->data['manager'] ); ?>"/>
				</label>
			</div>
		</div>

		<div>
			<div class="form-element">
				<span class="form-label"><?php esc_html_e( 'Reference', 'theepi' ); ?></span>
				<label class="form-field-container">
					<span class="form-field-icon-prev"><i class="fas fa-barcode"></i></span>
					<input type="text" class="form-field" name="reference" value="<?php echo esc_attr( $epi->data['reference'] ); ?>"/>
				</label>
			</div>
		</div>

		<div>
			<div class="form-element form-element-required">
				<span class="error" style="color : red ; float : right"></span>
				<span class="form-label"><?php esc_html_e( 'Lifetime', 'theepi' ); ?></span>
				<label class="form-field-container">
					<span class="form-field-icon-prev"><i class="fas fa-heart"></i></span>
					<input class="form-field" type="number" name="lifetime" value="<?php echo esc_attr( $epi->data['lifetime_epi'] ); ?>"/>
					<span class="form-field-label-next"><?php echo esc_html_e( 'years', 'theepi' ); ?></span>
				</label>
			</div>
		</div>

		<div>
			<div class="form-element form-element-required">
				<span class="error" style="color : red ; float : right"></span>
				<span class="form-label"><?php esc_html_e( 'Periodicity', 'theepi' ); ?></span>
				<label class="form-field-container">
					<span class="form-field-icon-prev"><i class="far fa-calendar-check"></i></span>
					<input class="form-field" type="number" name="periodicity" value="<?php echo esc_attr( $epi->data['periodicity'] ); ?>"/>
					<span class="form-field-label-next"><?php echo esc_html_e( 'days', 'theepi' ); ?></span>
				</label>
			</div>
		</div>

		<div>
			<?php if( $manufacture_date_valued == "" ): ?>
			<div class="form-element form-element-required group-date">
				<span class="error" style="color : red ; float : right"></span>
				<span class="form-label"><?php esc_html_e( 'Manufacture Date', 'theepi' ); ?></span>
				<label class="form-field-container">
					<span class="form-field-icon-prev"><i class="fas fa-calendar-alt"></i></span>
					<input type="hidden" class="mysql-date"  name="manufacture-date" />
					<?php if( $epi->data['manufacture_date_valid'] ): ?>
						<input class="form-field date" type="text" name="manufacture-date"
						value="<?php echo esc_attr( $epi->data['manufacture_date']['rendered']['date'] ); ?>"/>
					<?php else: ?>
						<input class="form-field date" type="text" name="manufacture-date"
						value=""/>
					<?php endif; ?>
				</label>
			</div>
			<?php endif; ?>
		</div>

		<div>
			<?php if( $checked_purchase_date == 0 ): ?>
			<div class="form-element form-element-required group-date">
				<span class="error" style="color : red ; float : right"></span>
				<span class="form-label"><?php esc_html_e( 'Purchase Date', 'theepi' ); ?> </span>
				<label class="form-field-container">
					<span class="form-field-icon-prev"><i class="fas fa-calendar-alt"></i></span>
						<input type="hidden" class="mysql-date" name="purchase-date" />
						<?php if( $epi->data['purchase_date_valid'] ):  ?>
							<input class="form-field date" type="text"  name="purchase-date"
							value="<?php echo esc_attr( $epi->data['purchase_date']['rendered']['date'] ); ?>"/>
						<?php else: ?>
							<input class="form-field date" type="text"  name="purchase-date"
							value=""/>
						<?php endif; ?>
				</label>
			</div>
			<?php endif; ?>
		</div>

		<div class="form-element" style="margin-top : 50px">
			<span class="wpeo-tooltip-event form-label" aria-label="<?php esc_html_e( 'Control Date = Commissioning Date + Periodicity', 'theepi' ); ?>" style="width : 10%; float : left"><?php esc_html_e( 'Control Date : ', 'theepi' ); ?>
				<?php if( $epi->data['commissioning_date_valid'] ): ?>
					<span class="form-label" name="control-date" value="<?php echo esc_attr( $epi->data['control_date']['rendered']['date'] ); ?>"><?php echo esc_attr( $epi->data['control_date']['rendered']['date'] ); ?></span>
				<?php else: ?>
					<span class="form-label" name="control-date" value=""></span>
				<?php endif; ?>
			</span>

			<span class="wpeo-tooltip-event form-label" aria-label="<?php esc_html_e( 'End Life Date = Manufacture Date + Lifetime', 'theepi' ); ?>" style="width : 10%; float : left"  ><?php esc_html_e( 'End Life Date : ', 'theepi' ); ?>
				<?php if( $epi->data['manufacture_date_valid'] ): ?>
					<span class="form-label" name="end-life-date" value="<?php echo esc_attr( $epi->data['end_life_date']['rendered']['date'] ); ?>"><?php echo esc_attr( $epi->data['end_life_date']['rendered']['date'] ); ?></span>
				<?php else: ?>
					<span class="form-label" name="end-life-date" value=""></span>
				<?php endif; ?>
			</span>

			<span class="wpeo-tooltip-event form-label" aria-label="<?php esc_html_e( 'Disposal Date = End Life Date', 'theepi' ); ?>" style="width : 10%; float : left" ><?php esc_html_e( 'Disposal Date : ', 'theepi' ); ?>
				<?php if( $epi->data['manufacture_date_valid'] ): ?>
					<span class="form-label" name="disposal-date" value="<?php echo esc_attr( $epi->data['disposal_date']['rendered']['date'] ); ?>"><?php echo esc_attr( $epi->data['disposal_date']['rendered']['date'] ); ?></span>
				<?php else: ?>
					<span class="form-label" name="disposal-date" value=""></span>
				<?php endif; ?>
			</span>
		</div>
	</form>
</fieldset>