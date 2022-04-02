<?php

/**
 * Gravity Forms Change Buttons
 * Filters the next, previous and submit buttons.
 * Replaces the forms <input> buttons with <button> while maintaining attributes from original <input>.
 *
 * @param string $button Contains the <input> tag to be filtered.
 * @param object $form Contains all the properties of the current form.
 *
 * @return string The filtered button.
 */
add_filter( 'gform_next_button', 'input_to_button', 10, 2 );
add_filter( 'gform_previous_button', 'input_to_button', 10, 2 );
add_filter( 'gform_submit_button', 'input_to_button', 10, 2 );
function input_to_button( $button, $form ) {
    $dom = new DOMDocument();
    $dom->loadHTML( $button );
    $input = $dom->getElementsByTagName( 'input' )->item(0);
    $new_button = $dom->createElement( 'button' );
    $new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
    $input->removeAttribute( 'value' );
    foreach( $input->attributes as $attribute ) {
        $new_button->setAttribute( $attribute->name, $attribute->value );
    }
    $input->parentNode->replaceChild( $new_button, $input );
    return $dom->saveHtml( $new_button );
}


/**
* Gravity Forms jQuery Compatibility Fix
* Moves GF JS to footer to elminate jquery errors in console
*/
add_filter('gform_init_scripts_footer', '__return_true');
// can be used in a function if needed, see below
/*function function_name() {
    return true;
}*/

/**
* Gravity Forms Confirmation Anchor
* Disables jumping to top of page after submit/submit error
*/
add_filter( 'gform_confirmation_anchor', '__return_true' );
// can be used in a function if needed, see below
/*function function_name() {
    return true;
}*/

/**
* Gravity Forms Hide Labels
* Enable drop down toggle to hide fields on a per-case basis
*/
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );