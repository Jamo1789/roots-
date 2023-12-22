<?php get_header(); // Include the header ?>
<style>
  .zoom-background {
    background-image: url('<?php echo get_theme_file_uri('bg3.png') ?>');
    background-size: cover;
    background-position: center center;
    height: 400px;
    animation: shrink 8s infinite alternate;
  }

  @keyframes shrink {
    0% {
      background-size: 110% 110%;
    }
    100% {
      background-size: 100% 100%;
    }
  }
  .hero-section{
    margin-top: 50px;
  }
</style>
<div class="hero-section">
<div class="p-5 text-center zoom-background rounded-3">
  <div class="mask rounded-3" style="background-color: rgba(0, 0, 0, 0.6); padding-bottom: 20px;">
    <div class="d-flex justify-content-center align-items-center h-100">
      <div class="text-white">
        <h1 class="mb-3">Oikea kumppani it-haasteisiin</h1>
        <h4 class="mb-3">Tarjoamme ICT-ratkaisuja, konsultointia ja teknistä asiakastukea vankalla asiantuntemuksella</h4>
        <a class="btn btn-outline-light btn-lg" href="#!" role="button">Lue lisää</a>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Hero -->
<div class="d-flex justify-content-center" style="margin-top:15px;">
<h3 id="changingText">Toiminnanohjaus..</h3>
</div>
<!-- Service Section -->
<!-- Service Section -->
<section class="container-fluid my-5 d-flex justify-content-center">
  <div class="row">
    <div class="col-md-4 mb-4">
      <div class="card bg-primary Regular shadow">
        <img src="<?php echo get_theme_file_uri('erplogo2.svg'); ?>" class="card-img-top mx-auto img-fluid" alt="Service 1" style="width: 100px; height: 100px; margin-top:10px; padding-left:10px;">
        <div class="card-body">
          <h5 class="card-title text-light">Toiminnanohjaus</h5>
          <p class="card-text text-light">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever sn book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
          <a href="#" class="btn btn-primary">Learn More</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card bg-secondary Regular shadow">
        <img src="<?php echo get_theme_file_uri('itlogo.svg'); ?>" class="card-img-top mx-auto img-fluid" alt="Service 2" style="width: 100px; height: 100px; margin-top:10px; padding-left:10px;">
        <div class="card-body">
          <h5 class="card-title text-light">Laitteet ja ohjelmistot</h5>
          <p class="card-text text-light">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever sn book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
          <a href="#" class="btn btn-primary">Learn More</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card bg-success Regular shadow">
        <img src="<?php echo get_theme_file_uri('lock.svg'); ?>" class="card-img-top mx-auto img-fluid" alt="Service 2" style="width: 100px; height: 100px; margin-top:10px; padding-left:10px;">
        <div class="card-body">
          <h5 class="card-title text-light">Tietoturva</h5>
          <p class="card-text text-light">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever sn book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
          <a href="#" class="btn btn-primary">Learn More</a>
        </div>
      </div>
    </div>
  </div>
</section>


<div class="container" id="randomblogposts">
    <div class="row">
        <?php
        // Query to retrieve random blog posts
        $args = array(
            'post_type' => 'post', // Change this to your custom post type if needed
            'orderby'   => 'rand', // Retrieve posts in random order
            'posts_per_page' => 3, // Number of posts to display (adjust as needed)
        );

        $random_posts_query = new WP_Query( $args );

        // Loop through random posts and display them
        if ( $random_posts_query->have_posts() ) :
            while ( $random_posts_query->have_posts() ) : $random_posts_query->the_post();
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail', array( 'class' => 'card-img-top' ) ); ?></a>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php the_title(); ?></h5>
                            <p class="card-text"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata(); // Restore global post data
        else :
            echo 'No posts found'; // Displayed if there are no posts
        endif;
        ?>
    </div>
</div>
<?php get_footer(); // Include the header ?>