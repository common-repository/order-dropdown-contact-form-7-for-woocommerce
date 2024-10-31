<?php 
add_action('wpcf7_admin_init','odwfcf7_woocommerce_order_tag_generator');
function odwfcf7_woocommerce_order_tag_generator($post){
    if (!class_exists('WPCF7_TagGenerator')) {
        return;
    }
    $tag_generator = WPCF7_TagGenerator::get_instance();
    $tag_generator->add( 'woocommerce_order', __( 'woocommerce_order', 'order-dropdown-contact-form-7-for-woocommerce' ) , 'odwfcf7_tag_generator_woocommerce_order' );
}


function odwfcf7_tag_generator_woocommerce_order($contact_form, $args = '' ){


	$args = wp_parse_args( $args, array() );
	
	$wpcf7_contact_form = WPCF7_ContactForm::get_current();
	$contact_form_tags = $wpcf7_contact_form->scan_form_tags();
	$type = 'woocommerce_order';
	$description = __( "Generate a form-tag for a Input woocommerce order dropdown.", 'order-dropdown-contact-form-7-for-woocommerce' );
	?>
	<div class="control-box">
		<fieldset>
			<legend><?php echo esc_attr($description); ?></legend>
			<table class="form-table">
				<tr>
					<th>
						<label for="<?php echo esc_attr( $args['content'] . '-filed_type' ); ?>"><?php echo esc_html( __( 'Field type', 'order-dropdown-contact-form-7-for-woocommerce' ) ); ?></label>
					</th>
					<td>
						<input type="checkbox" name="required" class=" required_files" required>
						<label><?php echo esc_html( __( 'Required Field', 'order-dropdown-contact-form-7-for-woocommerce' ) ); ?></label>
					</td>
				</tr>
				<tr>
					<th><?php echo esc_html( __( 'Name', 'order-dropdown-contact-form-7-for-woocommerce' ) ); ?></th>
					<td>
						<input type="text" name="name">
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-id' ); ?>"><?php echo esc_html( __( 'Id Attribute', 'order-dropdown-contact-form-7-for-woocommerce' ) ); ?></label></th>
					<td><input type="text" name="id" class="order_id oneline option" id="<?php echo esc_attr( $args['content'] . '-id' ); ?>" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Class Attribute', 'order-dropdown-contact-form-7-for-woocommerce' ) ); ?></label></th>
					<td><input type="text" name="class" class="order_value oneline option" id="<?php echo esc_attr( $args['content'] . '-class' ); ?>" /></td>
				</tr>
				<tr>
                    <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-status' ); ?>"><?php echo esc_html__( 'Order Status', 'order-dropdown-contact-form-7-for-woocommerce' ); ?></label>
                    </th>
                    <td>
                    	<fieldset>
                        <input type="text" name="status" class="catid oneline option"  id="<?php echo esc_attr( $args['content'] . '-status' ); ?>" />
                        <p class="description">
                            Use pipe | separated order status. <br/>(e.g.wc-pending|wc-processing|wc-on-hold).
                        </p>
                        </fieldset>
                    </td>
                </tr>

			</table>
		</fieldset>
	</div>
	<div class="insert-box"> 
		<input type="text" name="<?php echo esc_attr($type); ?>" class="tag code" readonly="readonly" onfocus="this.select()" />
		<div class="submitbox">
			<input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'order-dropdown-contact-form-7-for-woocommerce' ) ); ?>" />
		</div>
		<br class="clear" />
		<p class="description mail-tag">
			<label for="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>"><?php echo sprintf( esc_html( __( "To use the value input through this field in a mail field, you need to insert the corresponding mail-tag (%s) into the field on the Mail tab.", 'order-dropdown-contact-form-7-for-woocommerce' ) ), '<strong><span class="mail-tag"></span></strong>' ); ?>
				<input type="text" class="mail-tag code hidden" readonly="readonly" id="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>" />
			</label>
		</p>
	</div>
	<?php
	}
?>