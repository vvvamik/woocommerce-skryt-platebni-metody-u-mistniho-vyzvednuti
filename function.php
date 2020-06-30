/* skrytí plateb u místního vyzvednutí */
function we_gateway_disable_shipping( $available_gateways ) {
 
    global $woocommerce;
   
    if ( !is_admin() ) {
         
        $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
         
        $chosen_shipping = $chosen_methods[0];
        // skrýt dobírku 
        if ( isset( $available_gateways['cod'] ) && 0 === strpos( $chosen_shipping, 'local_pickup' ) ) {
            unset( $available_gateways['cod'] );
        }
        // skrýt bankovní převod
        if ( isset( $available_gateways['bacs'] ) && 0 === strpos( $chosen_shipping, 'local_pickup' ) ) {
            unset( $available_gateways['bacs'] );
        }
        //skrýt paypal
        if ( isset( $available_gateways['ppec_paypal'] ) && 0 === strpos( $chosen_shipping, 'local_pickup' ) ) {
            unset( $available_gateways['ppec_paypal'] );
        }
         
    }
     
	return $available_gateways;  
}
add_filter( 'woocommerce_available_payment_gateways', 'we_gateway_disable_shipping' );
