<?php
/**
 * We use WordPress's init hook to make sure
 * our blocks are registered early in the loading
 * process.
 *
 * @link https://developer.wordpress.org/reference/hooks/init/
 */
function register_acf_blocks() {
    /**
     * We register our block's with WordPress's handy
     * register_block_type();
     *
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */
     // Duplicate this line for every custom block required.
     // block.json MUST be called block.json.
    register_block_type( __DIR__ . '/test/block.json' );
}
// Here we call our register_acf_block() function on init.
add_action( 'init', 'register_acf_blocks' );
