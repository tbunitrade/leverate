<?php



const STARPLAST_AUTH_KEY = 'asdffd99js3nfd313fds223finh4j9f20';


function starplast_get_all_products() {

	$key = sanitize_key($_POST['key']);

	if($key != STARPLAST_AUTH_KEY){
		http_response_code(406);
		exit;
	}

//	$products = get_transient('productList');
//	// TODO: Remove (Forces cache invalidation)
	$products = false;
//
//

	if ( false === $products ) {

		$query = new WC_Product_Query( array(
			'limit' => -1,
			'orderby' => 'date',
			'order' => 'DESC',
		) );
		$productsRaw = $query->get_products();


		$products = array();
		// Pluck the id and title attributes
        $args = array( 'post_type' => 'product', 'posts_per_page' => 1, 'product_cat' => '',  );

        $loop = new WP_Query( $args );
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'single-post-thumbnail' );

        while ( $loop->have_posts() ) : $loop->the_post();
		    foreach ( $productsRaw as $product ) {



				$products[] = [
                    'url'      => $product->get_permalink(),
					'sku'      => $product->get_sku(),
					'title'   => $product->get_name(),
                    'img'   => $product->get_image( 'thumbnail')

				];
			}
        endwhile;
		}


//		set_transient( 'productList', $products, 1 * HOUR_IN_SECONDS);



	if ( empty( $products ) ) {
		return null;
	}

	return $products;

}


add_action( 'rest_api_init', function () {
	register_rest_route( 'starplast/v1', '/products', array(
		'methods' => 'POST',
		'callback' => 'starplast_get_all_products',
	) );
} );