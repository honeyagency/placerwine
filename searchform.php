<?php
/**
 * Template for displaying search forms
 *
 * @package WordPress
 * @subpackage Buscemi
 * @version 1.0
 */
$searchPlaceholder = get_field('field_59e8e8a0399d3', 'options');
$searchButton = get_field('field_59e8ea752b7e4', 'options');

?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php echo $searchPlaceholder; ?></span>
	</label>
	<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo $searchPlaceholder; ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit"><?php echo $searchButton;?></button>
</form>
