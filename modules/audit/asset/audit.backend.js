/**
 * Initialise l'objet "audit" ainsi que la méthode "init" obligatoire pour la bibliothèque EoxiaJS.
 *
 * @since 0.5.0
 * @version 0.5.0
 */

window.eoxiaJS.theEPI.Audit = {};

window.eoxiaJS.theEPI.Audit.init = function() {
	window.eoxiaJS.theEPI.Audit.event();
};

window.eoxiaJS.theEPI.Audit.event = function() {
	jQuery( document ).on( 'click', '.modal-header .button-toggle', window.eoxiaJS.theEPI.Audit.buttonToggle );

};

/**
 * Récupère l'état du bouton toggle.
 *
 * @since 0.5.0
 * @version 0.5.0
 *
 * @param  {ClickEvent} event [t]
 *
 * @return {void}
 */
window.eoxiaJS.theEPI.Audit.buttonToggle = function( event ) {

	var toggleON = jQuery( this ).hasClass( 'fa-toggle-on' );
	var nextStep = '';
	if (toggleON) {

		nextStep = 'KO';
		jQuery( this ).removeClass( "fa-toggle-on" ).addClass( "fa-toggle-off" );
		jQuery( this ).closest( '.modal-container' ).find( '.modal-footer' ).find( '.wpeo-button' ).attr('data-status-epi', 'KO' );
		jQuery( this ).closest( ".button-toggle-modal-headear" ).find( '.button-toggle-OK' ).attr({ 'style' : 'color : grey; font-weight : auto' });
		jQuery( this ).closest( ".button-toggle-modal-headear" ).find( '.button-toggle-KO' ).attr({ 'style' : 'color : black; font-weight : bold' });

	} else {

		nextStep = 'OK';
		jQuery( this ).removeClass( "fa-toggle-off" ).addClass( "fa-toggle-on" );
		jQuery( this ).closest( '.modal-container' ).find( '.modal-footer' ).find( '.wpeo-button' ).attr('data-status-epi', 'OK' );
		jQuery( this ).closest( ".button-toggle-modal-headear" ).find( '.button-toggle-OK' ).attr({ 'style' : 'color : black; font-weight : bold' });
		jQuery( this ).closest( ".button-toggle-modal-headear" ).find( '.button-toggle-KO' ).attr({ 'style' : 'color : grey; font-weight : auto' });

	}

	var id = jQuery( this ).closest( '.button-toggle-modal-headear' ).attr( 'data-id' );
	var action = jQuery( this ).closest( '.button-toggle-modal-headear' ).attr( 'data-action' );
	var nonce = jQuery( this ).closest( '.button-toggle-modal-headear' ).attr( 'data-nonce' );
	var data = {
		action: action,
		_wpnonce: nonce,
		id: id,
		next_step: nextStep
	};

	window.eoxiaJS.loader.display( jQuery( this ).closest( '.button-toggle-modal-headear' ) );
	window.eoxiaJS.request.send( jQuery( this ), data );

};

/**
 * Le callback en cas de réussite à la requête Ajax "create_task_audit".
 * Ajoute une tâche à l'audit de contrôle.
 *
 * @since 0.5.0
 * @version 0.5.0
 *
 * @param  {HTMLDivElement} triggeredElement  L'élement HTML déclenchant la requête Ajax.
 * @param  {Object}         response          Les données renvoyées par la requête Ajax.
 *
 * @return {void}
 */
window.eoxiaJS.theEPI.Audit.createdTaskAuditSuccess = function( triggeredElement, response ) {
	console.log( 'OK ');
	console.log( response.data.view  );
	var element = triggeredElement.closest( '.modal-container' ).find( '.modal-content' );
	var content = element.html();
	element.html( response.data.view + content );
};

/**
 * Le callback en cas de réussite à la requête Ajax "import_task_audit".
 * Importer une tâche à l'audit de contrôle.
 *
 * @since 0.5.0
 * @version 0.5.0
 *
 * @param  {HTMLDivElement} triggeredElement  L'élement HTML déclenchant la requête Ajax.
 * @param  {Object}         response          Les données renvoyées par la requête Ajax.
 *
 * @return {void}
 */
window.eoxiaJS.theEPI.Audit.ImportedTaskAuditSuccess = function( triggeredElement, response ) {
	console.log( 'OK ');
	console.log( response.data.view  );
	var element = triggeredElement.closest( '.wpeo-modal' );
	element .replaceWith( response.data.view );

};

/**
 * Le callback en cas de réussite à la requête Ajax "import_button_task_audit".
 * Importer les boutons sur l'audit de contrôle.
 *
 * @since 0.5.0
 * @version 0.5.0
 *
 * @param  {HTMLDivElement} triggeredElement  L'élement HTML déclenchant la requête Ajax.
 * @param  {Object}         response          Les données renvoyées par la requête Ajax.
 *
 * @return {void}
 */
window.eoxiaJS.theEPI.Audit.ImportedButtonTaskAuditSuccess = function( triggeredElement, response ) {
	var header = triggeredElement.closest( '.wpeo-modal' ).find( '.modal-header' ).find('.modal-title-header');
	header.html( response.data.modal_title );
	var content = triggeredElement.closest( '.wpeo-modal' ).find( '.modal-content' );
	content.html( response.data.view );
	var footer = triggeredElement.closest( '.wpeo-modal' ).find( '.modal-footer' );
	footer.html( response.data.buttons_view);

};

/**
 * Le callback en cas de réussite à la requête Ajax "control_epi".
 * Affiche le modal template pour effecter le contrôle.
 *
 * @since 0.5.0
 * @version 0.5.0
 *
 * @param  {HTMLDivElement} triggeredElement  L'élement HTML déclenchant la requête Ajax.
 * @param  {Object}         response          Les données renvoyées par la requête Ajax.
 *
 * @return {void}
 */
window.eoxiaJS.theEPI.Audit.ControlEPISuccess = function( triggeredElement, response ) {
	triggeredElement.closest( '.table-row' ).append( response.data.modal_template );
	triggeredElement.closest( '.epi-row' ).find( '.control_audit' ).html( response.data.view_item );
};

/**
 * Le callback en cas de réussite à la requête Ajax "display_control_epi".
 * Affiche la vue du dernier contrôle effectué.
 *
 *
 * @since 0.5.0
 * @version 0.5.0
 *
 * @param  {HTMLDivElement} triggeredElement  L'élement HTML déclenchant la requête Ajax.
 * @param  {Object}         response          Les données renvoyées par la requête Ajax.
 *
 * @return {void}
 */
window.eoxiaJS.theEPI.Audit.DisplayControlEPISuccess = function( triggeredElement, response ) {
	triggeredElement.parent().append( response.data.modal_template );
};

/**
 * Le callback en cas de réussite à la requête Ajax "valid_audit".
 * Valide le contrôle.
 *
 * @since 0.5.0
 * @version 0.5.0
 *
 * @param  {HTMLDivElement} triggeredElement  L'élement HTML déclenchant la requête Ajax.
 * @param  {Object}         response          Les données renvoyées par la requête Ajax.
 *
 * @return {void}
 */
window.eoxiaJS.theEPI.Audit.ValidAuditSuccess = function( triggeredElement, response ) {
	jQuery( '.wrap .container-content .epi .epi-row[ data-id="' + response.data.id + '"]' ).replaceWith( response.data.view );
	jQuery( '.wrap .container-content').before( response.data.notice );
	setTimeout( function() {
		jQuery( '.wrap.wpeo-wrap.wrap-theepi' ).find( '.wpeo-notice.notice-success' ).remove();
	}, 10000 );
};

/**
 * Le callback en cas de réussite à la requête Ajax "get_content_from_url_audit".
 * Récupère le texte d'une url github.
 *
 * @since 0.5.0
 * @version 0.5.0
 *
 * @param  {HTMLDivElement} triggeredElement  L'élement HTML déclenchant la requête Ajax.
 * @param  {Object}         response          Les données renvoyées par la requête Ajax.
 *
 * @return {void}
 */
window.eoxiaJS.theEPI.Audit.GetContentFromUrlAuditSuccess = function( triggeredElement, response ){
    if( response.data.content != "" ){
        triggeredElement.closest( '.modal-content' ).find( 'textarea[ name="content"]' ).html( response.data.content );
    }
}

/**
 * Le callback en cas de réussite à la requête Ajax "display_all_audit".
 * Affiche tout les contrôle effectués sur un EPI.
 *
 * @since 0.5.0
 * @version 0.6.0
 *
 * @param  {HTMLDivElement} triggeredElement  L'élement HTML déclenchant la requête Ajax.
 * @param  {Object}         response          Les données renvoyées par la requête Ajax.
 *
 * @return {void}
 */
window.eoxiaJS.theEPI.Audit.DisplayAllAuditSuccess = function( triggeredElement, response ) {
	var toggleChevron = triggeredElement.find( '.icon' ).hasClass( 'fa-chevron-right' );

	if ( toggleChevron ) {
	 	triggeredElement.closest( '.display_all_audit' ).find( '.icon' ).removeClass( "fa-chevron-right" ).addClass( "fa-chevron-down" );
		triggeredElement.closest( '.epi-row.view' ).find( '.control_audit' ).html( response.data.view );
		//triggeredElement.closest( '.control_audit .tm-audit .audit-container' ).find( '.epi-item-link-control' ).remove();
	} else {
		triggeredElement.closest( '.display_all_audit' ).find( '.icon' ).removeClass( "fa-chevron-down" ).addClass( "fa-chevron-right" );
		jQuery( '.wrap .container-content .epi .epi-row[ data-id="' + response.data.id + '"]' ).find( '.control_audit').html( response.data.single_view_audit );

	}
};
