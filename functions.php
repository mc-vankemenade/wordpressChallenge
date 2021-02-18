<?php


add_theme_support( 'post-thumbnails' );
//function to define the type of custom movie post
function customMoviePost() {

    //array of the texts used in the admin menu
    $labels = array(
        'name'               => _x( 'movies', 'post type general name' ),
        'singular_name'      => _x( 'movie', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'book' ),
        'add_new_item'       => __( 'Add New Movie' ),
        'edit_item'          => __( 'Edit Movie' ),
        'new_item'           => __( 'New Movie' ),
        'all_items'          => __( 'All Movies' ),
        'view_item'          => __( 'View Movies' ),
        'search_items'       => __( 'Search Movies' ),
        'not_found'          => __( 'No movies found' ),
        'not_found_in_trash' => __( 'No movies found in the Trash' ), 
        'menu_name'          => 'Movies'
    );
    
    //array of post type properties
    $args = array(
        'labels'        => $labels,
        'description'   => 'A collection of movies',
        'public'        => true,
        'menu_position' => 5,
        'supports'      => array( 'title', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ),
        'has_archive'   => true,
    );
    register_post_type( 'movie', $args ); 
}

//adds the custom post function to wordpress on init
add_action( 'init', 'customMoviePost' );


//function to generate a set of movie type posts for testing. 
function createMoviePosts() {

    $args = array(
        'post_type'      => 'movie'
    );

    $posts = new WP_Query($args);

    //tests if there are any movie posts already. If there are, skips the function.
    if($posts -> have_posts()) {
        return;
        
    }

    //the amount of movie test posts to generate
    $postAmount = 10;

    //generates the predetermined amount of posts
    for ($i = 0; $i <= $postAmount - 1; $i++) {
        $postArg = array(
        'post_ID'       => $i,
        'post_type'     => 'movie',
        'post_title'    => "Preview movie post #{$i}",
        'post_content'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ornare arcu libero, dapibus vulputate urna dapibus quis. Sed molestie erat erat, in pellentesque massa ornare ac. Nunc ultricies porta tortor, eget ornare diam blandit et. Aenean gravida imperdiet risus ut suscipit. Donec ultricies nunc quis velit volutpat, consequat dignissim mauris aliquet. Sed id laoreet orci. Nunc sed faucibus nunc. Ut maximus dui vel sem viverra dignissim.
                            Sed orci metus, lacinia eu felis eget, fermentum faucibus tellus. Vestibulum lectus augue, dapibus eget sagittis quis, pulvinar id nibh. Vivamus fermentum tortor vitae ligula bibendum ultrices. Curabitur ultricies ut magna vel accumsan. Vestibulum et ante cursus leo sodales mollis vel non lorem. Morbi sem nisl, euismod et pellentesque in, rutrum eget risus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer eu luctus nibh. Donec ut velit placerat, tempor risus id, hendrerit dui. Proin condimentum est orci, quis rutrum nibh viverra eu. Nam pharetra nunc non nulla convallis malesuada. Morbi elementum lacinia dui, ac posuere quam sodales vel.
                            Fusce interdum metus et eros sollicitudin congue. Quisque accumsan, risus in efficitur tempor, ligula felis facilisis ipsum, quis lobortis orci ex non massa. Aenean non tortor pretium, consequat ante at, pulvinar',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_template' => 'single-movie.php'
        );

        $postID = wp_insert_post($postArg);

        //adds the custom tags meta tags to the movie posts containing director, genre, etc.
        add_post_meta($postID, 'director', 'Lorem Ipsum');
        add_post_meta($postID, 'genre', 'Lorem Ipsum');
        add_post_meta($postID, 'releaseDate', 'Lorem Ipsum');
        add_post_meta($postID, 'shortDesc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ac dapibus tellus. Phasellus sit amet accumsan magna. Praesent sed lobortis diam, in porttitor augue. Mauris sit amet lobortis sem.');
    }
}
add_action('init', 'createMoviePosts');

function createPages() {
    $args = array(
        'post_type'      => 'page'
    );

    $posts = new WP_Query($args);

    //tests if there are any pages on wordpress. if there are, skips the function.
    if($posts -> have_posts()) {
        return;
    }
    //defines the properties of the homepage.
    $homePage = array(
        'post_ID'       => 'home',
        'post_type'     => 'page',
        'post_title'    => 'Home',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_template' => 'index.php'
    );

    //inserts the homepage
    wp_insert_post($homePage);

    //defines the properties of the blog page.
    $blogPage = array(
        'post_ID'       => 'blog',
        'post_type'     => 'page',
        'post_title'    => 'Movies',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_template' => 'index.php'
    );

    //inserts the blog page.
    wp_insert_post($blogPage);

    //sets the home page as the main page when you visit the site. DOESNT WORK FOR SOME REASON...
    update_option( 'page_on_front', 'home' );
    update_option( 'show_on_front', 'page' );
    //sets the blog page as the dedicated blog listing page. DOESNT WORK FOR SOME REASON...
    update_option( 'page_for_posts', 'blog' );
}
add_action('init', 'createPages');

function registerMenus() {

    //registers the main menu for use in the header
    register_nav_menus( array(
        'header_menu'   => 'Header Menu',
    ));

    //possible function to register the generated home and posts page in the menu...
}
add_action('init', 'registerMenus');

//registers stylesheet
function enqueueStyle() {
	wp_enqueue_style( 'style', get_stylesheet_uri());
}
add_action( 'wp_enqueue_scripts', 'enqueueStyle' );


/* dingen die ik nog wilde toevoegen

    - admin menu om test posts te maken en pagina's toe te voegen
    - automatisch installen van gemaakte pagina's als hoofd- en blogpagina.
    - automatisch instellen van post featured foto
    - menu's automatisch instellen


*/
?>