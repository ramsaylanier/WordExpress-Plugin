<?php

function wordexpress_page_fields_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function wordexpress_page_fields_add_meta_box() {
	add_meta_box(
		'wordexpress_page_fields-wordexpress-page-fields',
		__( 'WordExpress Page Fields', 'wordexpress_page_fields' ),
		'wordexpress_page_fields_html',
		'page',
		'normal',
		'low'
	);
}
add_action( 'add_meta_boxes', 'wordexpress_page_fields_add_meta_box' );

function wordexpress_page_fields_html( $post) {
	wp_nonce_field( '_wordexpress_page_fields_nonce', 'wordexpress_page_fields_nonce' ); ?>

	<p>
		<label for="wordexpress_page_fields_page_layout_component"><?php _e( 'Page Layout Component', 'wordexpress_page_fields' ); ?></label><br>
		<input type="text" name="wordexpress_page_fields_page_layout_component" id="wordexpress_page_fields_page_layout_component" value="<?php echo wordexpress_page_fields_get_meta( 'wordexpress_page_fields_page_layout_component' ); ?>">
	</p><?php
}

function wordexpress_page_fields_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['wordexpress_page_fields_nonce'] ) || ! wp_verify_nonce( $_POST['wordexpress_page_fields_nonce'], '_wordexpress_page_fields_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['wordexpress_page_fields_page_layout_component'] ) )
		update_post_meta( $post_id, 'wordexpress_page_fields_page_layout_component', esc_attr( $_POST['wordexpress_page_fields_page_layout_component'] ) );
}
add_action( 'save_post', 'wordexpress_page_fields_save' );

/*
	Usage: wordexpress_page_fields_get_meta( 'wordexpress_page_fields_page_layout_component' )
*/
?>
