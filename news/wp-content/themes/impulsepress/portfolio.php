<?php
/**
 * Portfolio Page Template
 *
 * Template Name:  Portfolio Page
 *
 * @file           portfolio.php
 * @package        Impulse Press
 * @author         Two Impulse
 * @copyright      2014 Two Impulse
 * @license        license.txt
 * @version        Release: 1.3
 */

get_header(); ?>

<?php
$portfolio_cols_option = get_post_meta( $post->ID, 'ip_portfolio_num_cols', true );
$portfolio_cols = 'col' . $portfolio_cols_option;
?>

<?php get_template_part('portfolio-content'); ?>
<?php get_footer(); ?>