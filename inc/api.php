<?php
/**
 * Customize the response from WP API.
 *
 * Endpoint: http://HOME_URL.COM/wp/v2/posts?filter[orderby]=rand&filter[posts_per_page]=1
 *
 * @link     http://v2.wp-api.org/
 */
/**
 * Add post status, source, and source URL fields to API request
 */
add_action( 'rest_api_init', function() {
      register_api_field( 'post',
      'post_status',
      array(
         'get_callback'    => 'qod_get_post_status',
         'update_callback' => 'qod_update_post_status',
         'schema'          => null,
      )
   );

   register_api_field( 'post',
      '_qod_quote_source',
      array(
         'get_callback'    => 'qod_get_quote_meta_fields',
         'update_callback' => 'qod_update_quote_meta_fields',
         'schema'          => null,
      )
   );

   register_api_field( 'post',
      '_qod_quote_source_url',
      array(
         'get_callback'    => 'qod_get_quote_meta_fields',
         'update_callback' => 'qod_update_quote_meta_fields',
         'schema'          => null,
      )
   );
});

/**
 * Handler for fetching the post status.
 *
 * @param array           $object     Details of current post.
 * @param string          $field_name Name of field to add to response.
 * @param WP_REST_Request $request    Current request.
 *
 * @return mixed
 */
function qod_get_post_status( $object, $field_name, $request ) {
    $post = get_post( $object['id'] );
    return $post->post_status;
}

/**
 * Handler for updating post status.
 *
 * @since 0.1.0
 *
 * @param mixed  $value      The value of the field.
 * @param object $object     The object from the response.
 * @param string $field_name Name of field.
 *
 * @return bool|int
 */
function qod_update_post_status( $value, $object, $field_name ) {
   if ( ! $value || ! is_string( $value ) ) {
      return;
   }

   $post = get_post( $object->ID );
   $post->post_status = $value;
   return wp_update_post( $post );
}

/**
 * Handler for fetching post meta fields.
 *
 * @param array           $object     Details of current post.
 * @param string          $field_name Name of field to add to response.
 * @param WP_REST_Request $request    Current request.
 *
 * @return mixed
 */
function qod_get_quote_meta_fields( $object, $field_name, $request ) {
   return get_post_meta( $object['id'], $field_name, true );
}

/**
 * Handler for updating custom field data.
 *
 * @since 0.1.0
 *
 * @param mixed  $value      The value of the field.
 * @param object $object     The object from the response.
 * @param string $field_name Name of field.
 *
 * @return bool|int
 */
function qod_update_quote_meta_fields( $value, $object, $field_name ) {
   if ( ! $value || ! is_string( $value ) ) {
      return;
   }

   return update_post_meta( $object->ID, $field_name, strip_tags( $value ) );
}
