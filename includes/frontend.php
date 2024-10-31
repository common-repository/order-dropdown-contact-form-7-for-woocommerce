<?php 
add_action( 'wpcf7_init' , 'odwfcf7_add_form_tag_woocommerce_order' , 10, 0 );
function odwfcf7_add_form_tag_woocommerce_order() {
	wpcf7_add_form_tag( array( 'woocommerce_order', 'woocommerce_order*' ), 'odwfcf7_woocommerce_order_tag_handler',array('name-attr' => true) );
}


function odwfcf7_woocommerce_order_tag_handler($tag){
	if ( empty( $tag->name ) ) {
		return '';
	}

	$validation_error = wpcf7_get_validation_error( $tag->name );

	$class = wpcf7_form_controls_class( $tag->type );

	if ( $validation_error ) {
		$class .= ' wpcf7-not-valid';
	}

	$atts = array();

	$class = $atts['class'] = $tag->get_class_option( $class );
	$id = $atts['id'] = $tag->get_id_option();
	$status = $atts['status'] = $tag->get_option( 'status', '', true );
	


	if ( $tag->has_option( 'readonly' ) ) {
		$atts['readonly'] = 'readonly';
	}

	if ( $tag->is_required() ) {
		$atts['aria-required'] = 'true';
	}

	if ( $validation_error ) {
		$atts['aria-invalid'] = 'true';
		$atts['aria-describedby'] = wpcf7_get_validation_error_reference(
			$tag->name
		);
	} else {
		$atts['aria-invalid'] = 'false';
	}

	$status_arr = explode("|",$status);
	//print_r ($status_arr);

	$atts['name'] = $tag->name;
	$atts['type'] = 'hidden';

	$orders_arg = array( 
		'type' => 'shop_order',
        'status' => $status_arr,
    );
    $orders_loop = wc_get_orders($orders_arg);

	$atts = wpcf7_format_atts( $atts );
	$html ='<div class="odwfcf7_woocommerce_order wpcf7-form-control-wrap" data-name="' . $tag->name . '">';
	$html = $html . '<select name="'.$tag->name.'" id="'.$id.'" class="'.$class.'" status="'.$status.'">';
	$html = $html . '<option value="">Select Order</option>';
	foreach ($orders_loop as $order) {
		$id = $order->get_id();
		$order_data = $order->get_data(); 
		$order_status = $order_data['status'];
		$order_date_created = $order_data['date_created']->date('M d, Y');

		$html = $html . '<option value="#'.$id.'(Status: '.$order_status.') - (Date: '.$order_date_created.')">#'.$id.'(Status: '.$order_status.') - (Date: '.$order_date_created.')</option>';
	}
	$html = $html . '</select>';
	$html = $html . '</div>';

	return $html;
}

add_filter( 'wpcf7_validate_woocommerce_order' , 'odwfcf7_woocommerce_order_validation_filter' , 10, 2 );
add_filter( 'wpcf7_validate_woocommerce_order*' , 'odwfcf7_woocommerce_order_validation_filter' , 10, 2 ); 
function odwfcf7_woocommerce_order_validation_filter( $result, $tag ) {
    $odwfcf7data = sanitize_text_field($_POST[$tag->name]);

    $value = isset( $_POST[$tag->name] ) ? sanitize_text_field(trim( strtr( (string) $odwfcf7data, "\n", " " ) )) : '';
    if ( 'woocommerce_order' == $tag->basetype ) {
        if ( $tag->is_required() and '' === $value ) {
            $result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
        }
    }
    return $result;
}