<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="copyright" content="Copyright (C) Boyaki-Channel. All Rights Reserved.">

<!-- <link rel="apple-touch-icon" sizes="57x57" href="/favicons/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/favicons/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/favicons/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/favicons/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/favicons/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/favicons/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/favicons/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/favicons/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="/favicons/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
<link rel="shortcut icon" href="/favicons/favicon.ico"> -->

<link rel="index" href="/">
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/foundation.css" type="text/css" />
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/style.css" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Alegreya|Ruluko|Source+Sans+Pro|Courgette|Droid+Sans|Noto+Sans" rel="stylesheet">

<?php echo_meta_description_tag(); ?>
<?php echo_meta_keywords_tag(); ?>

<!-- OGP -->
<meta property="og:type" content="blog">
<?php
if (is_single()){//単一記事ページの場合
  if(have_posts()): while(have_posts()): the_post();
    echo '<meta property="og:description" content="'.$post->post_excerpt.'">';echo "\n";//抜粋を表示
  endwhile; endif;
    echo '<meta property="og:title" content="'; the_title(); echo '">';echo "\n";//単一記事タイトルを表示
    echo '<meta property="og:url" content="'; the_permalink(); echo '">';echo "\n";//単一記事URLを表示
} else {//単一記事ページページ以外の場合（アーカイブページやホームなど）
  echo '<meta property="og:description" content="'; bloginfo('description'); echo '">';echo "\n";//「一般設定」管理画面で指定したブログの説明文を表示
  echo '<meta property="og:title" content="'; bloginfo('name'); echo '">';echo "\n";//「一般設定」管理画面で指定したブログのタイトルを表示
  echo '<meta property="og:url" content="'; bloginfo('url'); echo '">';echo "\n";//「一般設定」管理画面で指定したブログのURLを表示
}
$str = $post->post_content;
$searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';//投稿にイメージがあるか調べる
if (is_single()){//単一記事ページの場合
  if (has_post_thumbnail()){//投稿にサムネイルがある場合の処理
    $image_id = get_post_thumbnail_id();
    $image = wp_get_attachment_image_src( $image_id, 'full');
    echo '<meta property="og:image" content="'.$image[0].'">';echo "\n";
    } else if ( preg_match( $searchPattern, $str, $imgurl ) && !is_archive()) {//投稿にサムネイルは無いが画像がある場合の処理
    echo '<meta property="og:image" content="'.$imgurl[2].'">';echo "\n";
  } else {//投稿にサムネイルも画像も無い場合の処理
    echo '<meta property="og:image" content="http://misawayanohanashi.com/wp/wp-content/uploads/2016/06/IMG_1169.jpg">';echo "\n";
  }
} else {//単一記事ページページ以外の場合（アーカイブページやホームなど）
echo '<meta property="og:image" content="http://misawayanohanashi.com/wp/wp-content/uploads/2016/06/IMG_1169.jpg">';echo "\n";
}
?>
<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<!-- //OGP -->

<?php wp_head() ?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P3J5JDD');</script>
<!-- End Google Tag Manager -->

<!-- Map API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDd126lD7r8GX7-QStX7g3RyOCNTZaWRKI"></script>

<noscript>
<p class="underConstruction">JavaScriptを有効にしてください。</p>
</noscript>
</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P3J5JDD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<header class="l-header text-center clearfix">

  <div class="inner container">

    <div class="header-social social-pc">
      <ul>
        <li><a href="https://twitter.com/Boyaki_Channel" target="_blank" class="header-social__link"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/common/ico_twitter_bl.png" alt="Twitter" class="header-social__image" /></a></li>
        <li><a href="https://www.youtube.com/channel/UCoildZS48WA5uKyNoyuGg0g" target="_blank" class="header-social__link"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/common/ico_youtube_bl.png" alt="YouTube" class="header-social__image" /></a></li>
      </ul>
    </div>

    <div class="logo text-center">
      <a href="/">
        <div class="hover">
          <?php if (is_page(home)) { ?>
            <h1 class="logo--primary"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/common/logo_header.png" alt="Boyaki Channel" class="logo-header__image" /></h1>
          <?php } else { ?>
            <p class="logo--primary"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/common/logo_header.png" alt="Boyaki Channel" class="logo-header__image" /></p>
          <?php } ?>
        </div>
      </a>
    </div>

    <nav class="header-button js-slide-button" style="display:none;">
      <span class="ico_humbarger"></span>
      <span class="ico_humbarger ico_humbarger--second"></span>
      <span class="ico_humbarger ico_humbarger--third"></span>
    </nav>

  </div>

</header>

<!-- PCSP共通固定ナビゲーション -->
<!-- <nav class="nav-global js-slide">
  <ul class="nav-global__block">
    <li class="nav-global__list nav-global__list--title font-display"><span class="nav-global__text--title">Category</span><span class="nav-global__button-close js-slide-button">×</span></li>
    <li class="nav-global__list"><a href="" class="txt_c_333 nav-global__link"><span class="nav-global__text--primary">カテゴリ</span><span class="nav-global__text--secondary font-display">Misawaya</span></a></li>
    <li class="nav-global__list"><a href="" class="txt_c_333 nav-global__link">カテゴリ<span class="nav-global__text--secondary font-display">Local</span></a></li>
    <li class="nav-global__list"><a href="" class="txt_c_333 nav-global__link">カテゴリ<span class="nav-global__text--secondary font-display">Life</span></a></li>
    <li class="nav-global__list"><a href="" class="txt_c_333 nav-global__link">カテゴリ<span class="nav-global__text--secondary font-display">Food</span></a></li>
    <li class="nav-global__list"><a href="" class="txt_c_333 nav-global__link">カテゴリ<span class="nav-global__text--secondary font-display">Info</span></a></li>
  </ul>
</nav> -->
<!-- //PCSP共通固定ナビゲーション -->

<div class="js-overlay"></div>
