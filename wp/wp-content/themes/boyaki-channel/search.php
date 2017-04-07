<?php get_header(); ?>
<div class="l-content">
	<?php breadcrumbs(); ?>

	<div class="container">

		<div class="l-main">

			<div class="archive-article mar_b_50">

			  <h1 class="category-title">「<?php the_search_query(); ?>」の検索結果 : <?php echo $wp_query->found_posts; ?>件</h1>


				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" class="archive-article__item clearfix">

					<a href="<?php the_permalink() ?>">
						<img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>" class="archive-article__image mar_b_5 float-left" />
					</a>

					<div class="archive-article__text float-right">
						<div class="archive-article__text--property">
							<time class="archive-article__time txt_c_888"><?php echo get_post_time('M j, Y'); ?></time>
              <?php
              $cats = get_the_category();
              foreach($cats as $cat){
                echo '<a href="'.get_category_link($cat->term_id).'" ';
                echo 'class="txt_12 archive-article__link--category archive-article__link--'.esc_attr($cat->slug).'">';
                echo esc_html($cat->name);
                echo '</a>';
              }
              ?>

						</div>
						<h2><a href="<?php the_permalink() ?>" class="archive-article__link--title"><?php the_title(); ?></a></h2>
					</div>

				</article>

				<?php endwhile; else : ?>
					<p>該当する記事がありません</p>
				<?php endif; ?>

				<?php if (function_exists("pagination")) {
					pagination($additional_loop->max_num_pages);
				} ?>

			</div>

		</div>

		<?php get_sidebar(); ?>

	</div>

</div>
<?php get_footer(); ?>
