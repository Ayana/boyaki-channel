<div class="l-side mar_b_30">

	<div id="search-2" class="widget widget_search">
		<form role="search" method="get" id="searchform" class="searchform" action="/">
			<div>
				<input type="text" value="" name="s" id="s">
				<input type="submit" id="searchsubmit" value="検索">
			</div>
		</form>
	</div>

	<?php
		$pickposts = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		$wp_query->query('post_type=post' . '&posts_per_page=5' . '&tag=pick' . '&paged=' . $paged);
	?>

	<?php if (have_posts()) : ?>
		<div class="widget">
			<div class="widget__text--title font-display">Information</div>
			<ul>
				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				<li>
					<a href="<?php the_permalink(); ?>">
						<img src="<?php echo catch_that_image(); ?>" alt="<?php the_title(); ?>" class="" />
						<span class="title"><?php the_title(); ?></span>
					</a>
				</li>
				<?php endwhile; ?>
				<?php $wp_query = null; $wp_query = $pickposts; ?>
			</ul>
		</div>
	<?php endif; ?>




	<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>

		<?php dynamic_sidebar( 'sidebar' ); ?>

	<?php else : ?>

		<div class="widget">
		<h2>No Widget</h2>
		<p>ウィジットは設定されていません。</p>
		</div>

	<?php endif; ?>



	<!-- <div class="bnr-area">
		<a href="http://www.misawaya.shop/" target="_blank"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/common/bnr_shop.jpg" alt="箕澤屋のオンラインショップ" target="_blank"></a>
	</div> -->

	<!-- <div class="twitter">
		<div class="twitter-timeline__wrapper">
			<a class="twitter-timeline" data-height="350" data-theme="light" href="https://twitter.com/Ayao3308">Tweets by Ayao3308</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		</div>
		<div class="twitter-button__wrapper">
			<a href="https://twitter.com/Ayao3308" class="twitter-follow-button" data-show-count="false" data-dnt="true">Follow @Ayao3308</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		</div>
	</div> -->

</div>
