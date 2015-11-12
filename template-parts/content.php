<?php
/**
 * Template part for displaying posts.
 *
 * @package RED_Starter_Theme
 */
?>



<div ng-app="quotesondev">
	<quote-rotator
	id="post-<?php the_ID();?>"
	<?php post_class(); ?>
	></quote-rotator>
</div>
   


