window.eoxiaJS.digiriskEPI.epi = {};

window.eoxiaJS.digiriskEPI.epi.init = function() {
	window.eoxiaJS.digiriskEPI.epi.event();
};

window.eoxiaJS.digiriskEPI.epi.event = function() {};

/**
 * Le callback en cas de réussite à la requête Ajax "save_epi".
 * Remplaces le contenu de <tbody> du tableau "epi".
 *
 * @param  {HTMLDivElement} triggeredElement  L'élement HTML déclenchant la requête Ajax.
 * @param  {Object}         response          Les données renvoyées par la requête Ajax.
 * @return {void}
 *
 * @since 0.0.0.1
 * @version 0.0.0.1
 */
window.eoxiaJS.digiriskEPI.epi.savedEpiSuccess = function( element, response ) {
  jQuery( '.digirisk-wrap' ).replaceWith( response.data.template );
};

/**
 * Le callback en cas de réussite à la requête Ajax "load_epi".
 * Remplaces la ligne courante du tableau "epi"
 *
 * @param  {HTMLDivElement} triggeredElement  L'élement HTML déclenchant la requête Ajax.
 * @param  {Object}         response          Les données renvoyées par la requête Ajax.
 * @return {void}
 *
 * @since 0.0.0.1
 * @version 0.0.0.1
 */
window.eoxiaJS.digiriskEPI.epi.loadedEpiSuccess = function( element, response ) {
  jQuery( element ).closest( 'tr' ).replaceWith( response.data.template );
};

/**
 * Le callback en cas de réussite à la requête Ajax "delete_epi".
 * Supprimes la ligne courante du tableau "epi"
 *
 * @param  {HTMLDivElement} triggeredElement  L'élement HTML déclenchant la requête Ajax.
 * @param  {Object}         response          Les données renvoyées par la requête Ajax.
 * @return {void}
 *
 * @since 0.0.0.1
 * @version 0.0.0.1
 */
window.eoxiaJS.digiriskEPI.epi.deletedEpiSuccess = function( element, response ) {
  jQuery( element ).closest( 'tr' ).fadeOut();
};

/**
 * Vérifie si le champ période de controle est bien un nombre pour continuer le formulaire d'ajout d'un EPI.
 *
 * @param  {HTMLDivElement} element Le bouton pour ajouter un EPI
 * @return {boolean}
 *
 * @since 0.0.0.1
 * @version 0.0.0.1
 */
window.eoxiaJS.digiriskEPI.epi.checkData = function( element ) {
	if ( isNaN( jQuery( element ).closest( '.epi-row' ).find( 'input[name="frequency_control"]' ).val() ) || '' == jQuery( element ).closest( '.epi-row' ).find( 'input[name="frequency_control"]' ).val() ) {
		jQuery( element ).closest( '.epi-row' ).find( 'td.tooltip' ).addClass( 'active' );
		return false;
	}

	jQuery( element ).closest( '.epi-row' ).find( 'td.tooltip.active' ).removeClass( 'active' );

	return true;
};
