<?php
/**
 * Plugin Name:       Nombre de tu Plugin
 * Plugin URI:        https://ejemplo.com/mi-plugin
 * Description:       Una breve descripción de lo que hace este plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Tu Nombre
 * Author URI:        https://tusitio.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mi-plugin
 * Domain Path:       /languages
 */

// Avoiding executions from url
defined('ABSPATH') or die('Ooooops! You cannot access this file kys ');

class Projects{

    function __construct(){
        // Define shortcodes
    }

    function execute_actions(){
        // Launch actions to create CPT
        // Register CPT
        add_action( 'init',array($this , 'dml_projects_register') );
    }

    function dml_projects_register(){
        $supports = array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'author',
            'comments'
        );
        $labels = array(

        );
        $args = array(
            'supports' => $supports,
            'labels' => $labels,
        );
        // No mas de 12 caracteres, minuscula e identificativo
        register_post_type('projects',$args);
    }
}
if (class_exists('Projects')) {
    $projects = new Projects();
    $projects->execute_actions();

}