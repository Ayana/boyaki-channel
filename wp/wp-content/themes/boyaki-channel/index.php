<?php get_header(); ?>

<!-- <div class="visual container">
  <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/home/img_visual.jpg" alt="">
</div> -->

<div class="l-content">

	<div class="container">

		<div class="l-main">

			<div class="top-article">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" class="top-article__item clearfix">

					<a href="<?php the_permalink() ?>">
						<img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>" class="top-article__image mar_b_5 float-left" />
					</a>

					<div class="top-article__text float-right">
						<div class="top-article__text--property">
							<time class="top-article__time txt_c_888"><?php echo get_post_time('M j, Y'); ?></time>
              <?php
              $cats = get_the_category();
              foreach($cats as $cat){
                echo '<a href="'.get_category_link($cat->term_id).'" ';
                echo 'class="top-article__link--category top-article__link--'.esc_attr($cat->slug).'">';
                echo esc_html($cat->name);
                echo '</a>';
              }
              ?>
						</div>

						<h2><a href="<?php the_permalink() ?>" class="top-article__link--title"><?php the_title(); ?></a></h2>
					</div>

				</article>

  			<?php endwhile; else : ?>
  				<p>記事がありません</p>
  			<?php endif; ?>


				<?php if (function_exists("pagination")) {
					pagination($additional_loop->max_num_pages);
				} ?>

				<!-- <div class="mar_t_50 text-center">
					<a href="/column/" class="button--more font-display">Read More</a>
				</div> -->

			</div>

		</div>

		<?php get_sidebar(); ?>
	</div>

</div>
<?php get_footer(); ?>
