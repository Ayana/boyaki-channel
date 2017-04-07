<?php
///////////////////// WordPressデフォルトのjQueryをGoogleAPIに変更　/////////////////////
function change_jquery() {
  if( !is_admin() ){
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js', array(), '1.10.2');
  }
}
add_action('init', 'change_jquery');

///////////////////// 何番目の記事か表示　/////////////////////
function get_post_number( $post_type = 'post', $op = '<=' ) {
    global $wpdb, $post;
    $post_type = is_array($post_type) ? implode("','", $post_type) : $post_type;
    $number = $wpdb->get_var("
        SELECT COUNT( * )
        FROM $wpdb->posts
        WHERE post_date {$op} '{$post->post_date}'
        AND post_status = 'publish'
        AND post_type = ('{$post_type}')
    ");
    return $number;
}

///////////////////// タイトルタグ生成　/////////////////////
add_theme_support('title-tag');

///////////////////// タイトルタグからキャッチフレーズ削除　/////////////////////
function remove_tagline($title) {
	if ( isset($title['tagline']) ) {
		unset( $title['tagline'] );
	}
	return $title;
}
add_filter( 'document_title_parts', 'remove_tagline' );

///////////////////// カスタムフィールドからmeta keywords用のキーワードを取得する関数　/////////////////////
function get_meta_keywords() {
  global $post;
  $keywords = "";
  if ( is_home() ) {
    // ホームでは meta keywords にブログ名を設定
    // $keywords = get_bloginfo( 'name' );
    $keywords = 箕澤屋のハナシ;
  }
  elseif ( is_category() ) {
    // カテゴリーページではカテゴリー名を設定
    $keywords = single_cat_title('', false);
  }
  elseif ( is_single() ) {
    $custom_fields = get_post_custom();
    if ( isset($custom_fields['keywords']) ) {
      // 記事ページでは keywords カスタムフィールドの値を取得して設定
      $keywords = get_post_meta($post->ID, 'keywords', true);
    } else {
      // keywords カスタムフィールドが空ならカテゴリー名を設定
      foreach( get_the_category() as $index => $category ) {
        if ($index >= 1) {
          $keywords .= ',';
        }
        $keywords .= $category->cat_name;
      }
    }
  }
  else {
    $custom_fields = get_post_custom();
    if ( isset($custom_fields['keywords']) ) {
      // それ以外ページでは keywords カスタムフィールドの値を取得して設定
      $keywords = get_post_meta($post->ID, 'keywords', true);
    } else {
      // keywords カスタムフィールドが空ならタイトル名を設定
      $keywords = the_title($before, $after, $echo);
    }
  }

  return $keywords;
}

// meta keywords のタグを出力する関数
function echo_meta_keywords_tag() {
  echo '<meta name="keywords" content="' . get_meta_keywords() . ',BOYAKI,ボヤキチャンネル,ぼやきちゃんねる" />' . "\n";
}

///////////////////// excerptからmeta description用の説明文を取得する関数　/////////////////////
// get meta description from the content
function get_meta_description() {
  global $post;
  $description = "";
  if ( is_home() ) {
    // ホームでは、ブログの説明文を取得
    $description = get_bloginfo( 'description' );
  }
  elseif ( is_category() ) {
    // カテゴリーページでは、カテゴリーの説明文を取得
    $description = category_description();
  }
  elseif ( is_single() ) {
    if ($post->post_excerpt) {
      // 記事ページでは、記事本文から抜粋を取得
      $description = $post->post_excerpt;
    } else {
      // post_excerpt で取れない時は、自力で記事の冒頭100文字を抜粋して取得
      $description = strip_tags($post->post_content);
      $description = str_replace("\n", "", $description);
      $description = str_replace("\r", "", $description);
      $description = mb_substr($description, 0, 100) . "...";
    }
  }
  elseif ( is_page(about) ) {
    // aboutページの文章
    $description = '長野県箕輪町にある築150年の古民家 箕澤屋（みさわや）についてのページ。箕澤屋の概要、アクセス、家主について、リンクについてを記載しています。';
  }
  elseif ( is_page() ) {
    // 上記以外の固定ページでは、記事の冒頭100文字を抜粋して取得
    $description = strip_tags($post->post_content);
    $description = str_replace("\n", "", $description);
    $description = str_replace("\r", "", $description);
    $description = mb_substr($description, 0, 100) . "...";
  }
  else {
    // それ以外では、タイトル名を表示
    $description = the_title($before, $after, $echo);
  }

  return $description;
}

// echo meta description tag
function echo_meta_description_tag() {
  // トップ、カテゴリー、記事ページ、固定ページの場合は取得したデータをそのまま表示
  if ( is_home() || is_category() || is_single() || is_page() ) {
    echo '<meta name="description" content="' . get_meta_description() . '" />' . "\n";
  } // それ以外の場合はタイトル名＋ページです。
  else {
    echo '<meta name="description" content="' . get_meta_description() . 'のページです。" />' . "\n";
  }
}



///////////////////// 管理バーの表示のチェックをデフォルトで消す　/////////////////////
add_filter( 'show_admin_bar', '__return_false' );

///////////////////// カテゴリー説明文からpタグを削除　/////////////////////
remove_filter('term_description', 'wpautop');


///////////////////// Sidebars & Widgetizes Areas　/////////////////////
register_sidebar( array(
	'id' => 'sidebar',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<div class="widget__text--title font-display">',
	'after_title' => '</div>',
));

///////////////////// 投稿ページで最初の画像を取得 /////////////////////
function catch_that_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];

    if(empty($first_img)){ //Defines a default image
      $first_img = "/wp/wp-content/themes/boyaki-channel/images/common/no_image.jpg";
    }else{
      $first_img = substr_replace($first_img, '-300x200',strrpos($first_img,'.'),0) ;
    }
    return $first_img;
}

///////////////////// 固定ページに特定のカテゴリ一覧を表示させる /////////////////////
function Include_my_php($params = array()) {
    extract(shortcode_atts(array(
        'file' => 'default'
    ), $params));
    ob_start();
    include(get_theme_root() . '/' . get_template() . "/$file.php");
    return ob_get_clean();
}

add_shortcode('myphp', 'Include_my_php');

///////////////////// ページネーション設定　/////////////////////
function pagination($pages = '', $range = 2)
{
     $showitems = ($range * 2)+1;//表示するページ数（５ページを表示）

     global $paged;//現在のページ値
     if(empty($paged)) $paged = 1;//デフォルトのページ

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;//全ページ数を取得
         if(!$pages)//全ページ数が空の場合は、１とする
         {
             $pages = 1;
         }
     }

     if(1 != $pages)//全ページが１でない場合はページネーションを表示する
     {
		 echo "<div class=\"pagination columns menu align-center\">\n";
		 //Prev：現在のページ値が１より大きい場合は表示
         if($paged > 1) echo "<a href='".get_pagenum_link($paged - 1)."' class=\"prev\">前へ</a>\n";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                //三項演算子での条件分岐
                echo ($paged == $i)? "<span class=\"current\">".$i."</span>\n":"<a href='".get_pagenum_link($i)."'>".$i."</a>\n";
             }
         }
		//Next：総ページ数より現在のページ値が小さい場合は表示
		if ($paged < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\" class=\"next\">次へ</a>\n";
		echo "</div>\n";
     }
}

///////////////////// パンくずリスト設定　/////////////////////
// パンくずリスト
function breadcrumbs(){
  global $post;
  $str ='';
  if(!is_home()&&!is_page(home)&&!is_admin()){
    $str.= '<div id="breadcrumbs" class="breadcrumbs"><div class="menu container"><div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
    $str.= '<a href="'. home_url() .'" itemprop="url" class="home"><span itemprop="title"></span></a></div>';

    if(is_category()) {
      $cat = get_queried_object();
      if($cat -> parent != 0){
        $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
        foreach($ancestors as $ancestor){
          $str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor) .'" itemprop="url"><span itemprop="title">'. get_cat_name($ancestor) .'</span></a></div>';
        }
      }
    $str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. $cat-> cat_name . '</span></div>';
    } elseif(is_page()){
			if($post -> post_parent != 0 ){
				$ancestors = array_reverse(get_post_ancestors( $post->ID ));
				foreach($ancestors as $ancestor){
					$str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($ancestor).'" itemprop="url" ><span itemprop="title">'. get_the_title($ancestor) .'</span></a></div>';
									}
			}
			$str.= '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. $post -> post_title .'</span></div>';
		}
    elseif(is_single()){
      $categories = get_the_category($post->ID);
      $cat = $categories[0];
      if($cat -> parent != 0){
        $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
        foreach($ancestors as $ancestor){
          $str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor).'" itemprop="url"><span itemprop="title">'. get_cat_name($ancestor). '</span></a></div>';
        }
  			$str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($cat -> term_id). '" itemprop="url" ><span itemprop="title">'. $cat-> cat_name . '</span></a></div>';
      }
      $str.='<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($cat -> term_id). '" itemprop="url" ><span itemprop="title">'. $cat-> cat_name . '</span></a></div>';
			$str.= '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. $post -> post_title .'</span></div>';

    }
     else{
      $str.='<div>'. wp_title('', false) .'</div>';
    }
    $str.='</div></div>';
  }
  echo $str;
}

// 表示件数設定
function my_post_queries( $query ) {
  // 管理画面のクエリを変更せず、さらにメインクエリだけにする
  if ( ! is_admin() && $query->is_main_query() ) {

    // ホームとカテゴリーページのクエリを変更
    if ( is_home() || is_front_page() ) {
      $query->set( 'posts_per_page', 8 );
    }
    elseif ( is_category() || is_archive() ) {
      $query->set( 'posts_per_page', 10 );
    }
    else {
      $query->set( 'posts_per_page', 10 );
    }

  }
}
add_action( 'pre_get_posts', 'my_post_queries' );

///////////////////// 検索結果で固定ページを拾わず、記事ページのみに設定　/////////////////////
function SearchFilter($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','SearchFilter');

?>
