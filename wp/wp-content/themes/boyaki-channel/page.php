<?php get_header(); ?>

		<div class="container">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>">


				<h1 class="page-title"><?php the_title(); ?></h1>


				<section class="entry-content">
					<?php the_content(); ?>
				</section>


			</article>

			<?php endwhile; endif; ?>

			<?php get_sidebar(); ?>

		</div>

<?php get_footer(); ?>
