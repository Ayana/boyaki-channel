<?php
/*
Template Name: Watch Cookie
*/
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="copyright" content="Copyright (C) Misawaya. All Rights Reserved.">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow" />

<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/foundation.css" type="text/css" />
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/style.css" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Alegreya|Ruluko|Source+Sans+Pro|Courgette|Droid+Sans|Noto+Sans" rel="stylesheet">

<script>
// Analytics用コード（WatchCookie用コードあり）
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	// Watch Cookie用コード
	var dimensionValue = 'SOME_DIMENSION_VALUE';
	ga('set', 'dimension1', dimensionValue);
	// Watch Cookie用コード

  ga('create', 'UA-79192671-1', 'auto');
  ga('send', 'pageview');
</script>

<?php wp_head() ?>

<noscript>
<p class="underConstruction">JavaScriptを有効にしてください。</p>
</noscript>
</head>

<body <?php body_class(); ?>>

<header class="l-header text-center clearfix">

  <div class="inner container">

    <div class="logo text-center">
      <a href="/">
        <div class="hover">
          <p class="logo--secondary font-min txt_c_333">長野県箕輪町にある古民家を拠点にした話</p>
          <?php if (is_page(home)) { ?>
            <h1 class="logo--primary"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/common/logo_header.png" alt="信州箕輪町の古民家 箕澤屋のハナシ（みさわやのはなし）" class="logo-header__image" /></h1>
          <?php } else { ?>
            <p class="logo--primary"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/common/logo_header.png" alt="信州箕輪町の古民家 箕澤屋のハナシ（みさわやのはなし）" class="logo-header__image" /></p>
          <?php } ?>
        </div>
      </a>
    </div>

  </div>

</header>

<?php breadcrumbs(); ?>

<div class="container">
	<div class="l-content container">

		<div class="l-main">

			<h1 class="page-title"><?php the_title(); ?></h1>

			<?php if(have_posts()): while(have_posts()): the_post(); ?>
				<div class="container">
					<?php the_content(); ?>
				</div>
			<?php endwhile; endif; ?>

		</div>

	</div>

</div>

<?php get_footer(); ?>
