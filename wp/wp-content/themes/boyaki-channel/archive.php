<?php get_header(); ?>
<div class="l-content">
	<?php breadcrumbs(); ?>

	<div class="container">

		<div class="l-main">

			<div class="archive-article mar_b_50">

				<?php

					// タグ取得
					$tags = get_the_tags();
					if ( $tags ) {
						foreach ( $tags as $tag ) {
						  $tag_link = get_tag_link( $tag->term_id );
						}
					}
				?>


			  <?php if (is_tag()) { ?>
					<h1 class="category-title">「<?php single_cat_title(); ?>」の記事</h1>
			  <?php } elseif ($parent_catname) { ?>
					<h1 class="category-title"><?php single_cat_title(); ?></h1>
			  <?php } else { ?>
					<h1 class="category-title"><?php single_cat_title(); ?> カテゴリ記事一覧</h1>
			  <?php } ?>


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
                echo 'class="archive-article__link--category archive-article__link--'.esc_attr($cat->slug).'">';
                echo esc_html($cat->name);
                echo '</a>';
              }
              ?>

							<!-- <a href="<?php echo $cat_link; ?>" class="txt_12 archive-article__link--category archive-article__link--<?php echo $cat_slug; ?>"><?php echo $cat_name; ?></a> -->
						</div>
						<h2><a href="<?php the_permalink() ?>" class="archive-article__link--title"><?php the_title(); ?></a></h2>
					</div>

				</article>

				<?php endwhile; else : ?>
					<p>記事がありません</p>
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
