<?php get_header(); ?>
<div class="l-content">
	<?php breadcrumbs(); ?>

	<div class="container">

		<div class="l-main no<?php echo get_post_number( $post->post_type ); ?>">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="single-article mar_b_50">

				<h1 class="single-article--title"><?php the_title(); ?></h1>

				<div class="single-article--property">
					<time class="single-article__text--time txt_c_888"><?php echo get_post_time('M j, Y'); ?></time>

					<?php

						// タグ取得
						$tags = get_the_tags();
						if ( $tags ) {
							foreach ( $tags as $tag ) {
							  $tag_link = get_tag_link( $tag->term_id );
							}
						}

						// カテゴリー情報を取得
						foreach((get_the_category()) as $cat) {
						$cat_id = $cat->cat_ID ;
						$cat_name = $cat->cat_name;
						$cat_slug = $cat->category_nicename ;
						break ;
						}
						$cat_link = get_category_link( $cat_id );
					?>

					<?php if ( has_tag('pick')): ?>
					<?php elseif (has_tag()): ?>
						<a href="<?php echo $tag_link; ?>" class="single-article__link--tag single-article__link--<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a>
					<?php endif; ?>

					<a href="<?php echo $cat_link; ?>" class="single-article__link--category single-article__link--<?php echo $cat_slug; ?>"><?php echo $cat_name; ?></a>

				</div>

				<div class="single-article--content">

					<?php the_content(); ?>

					<?php endwhile; ?>

					<?php else : ?>

						<p>記事がありません</p>

					<?php endif; ?>

					<?php
					$post = get_queried_object();
					$cats = get_the_category($post->ID);
					foreach ($cats as $cat) :
					?>

				</div>

				<div class="pager">
				<?php if (get_next_post()):?>
				  <div class="next"><?php next_post_link('%link','次の記事：%title',false); ?></div>
				<?php endif; ?>

				<?php if (get_previous_post()):?>
				  <div class="prev"><?php previous_post_link('%link','前の記事',false); ?></div>
				<?php endif; ?>
				</div>

				<div class="article-related">

					<?php
					$post_id = get_the_ID();
					$q = new WP_Query(array('category__in' => $cat->term_id, 'posts_per_page' => 3, 'post__not_in' => array($post_id) ));
					if ($q->have_posts()) : ?>

						<div class="section-title mar_b_20">
							このカテゴリの他の記事
						</div>

						<?php while ($q->have_posts()) : $q->the_post(); ?>

							<div id="post-<?php the_ID(); ?>" class="article-related__item clearboth clearfix">

								<a href="<?php the_permalink() ?>" class="article-related__link--image mar_b_5">
									<img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>" class="article-related__image" />
								</a>
								<div class="article-related__text">
									<time class="article-related__text--time txt_c_888"><?php echo get_post_time('Y.m.d'); ?></time>
									<a href="<?php the_permalink() ?>" class="article-related__link--title"><?php the_title(); ?></a>
								</div>

							</div>

						<?php endwhile; ?>

						<div class="mar_t_50 text-center">
							<a href="<?php echo get_category_link($cat->term_id); ?>" class="button--more font-display">Read More</a>
						</div>

					<?php endif; ?>


					<?php endforeach; ?>


				</div>

			</div>

		</div>

		<?php get_sidebar(); ?>

	</div>

</div>
<?php get_footer(); ?>
