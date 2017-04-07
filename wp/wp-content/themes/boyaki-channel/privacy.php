<?php
/*
Template Name: Privacy
*/
?>

<?php get_header(); ?>

	<?php breadcrumbs(); ?>

	<div class="container">
		<div class="l-content container">

			<div class="l-main">

				<h1 class="page-title">プライバシーポリシー</h1>

				<?php if(have_posts()): while(have_posts()): the_post(); ?>
					<div class="container">
						<?php the_content(); ?>
					</div>
				<?php endwhile; endif; ?>

			</div>

			<?php get_sidebar(); ?>

		</div>

</div>

<?php get_footer(); ?>
