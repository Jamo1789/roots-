<?php get_header(); ?>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-8">
      <?php
      if (have_posts()) :
        while (have_posts()) : the_post();
      ?>
          <article <?php post_class(); ?>>
            <h1 class="mb-4"><?php the_title(); ?></h1>
            <div class="mb-4">
              <?php the_content(); ?>
            </div>
          </article>
      <?php
        endwhile;
      else :
        echo '<p>No content found</p>';
      endif;
      ?>
    </div>

    <div class="col-md-4">
      <!-- You can add a sidebar here if needed -->
    </div>
  </div>
</div>

<?php get_footer(); ?>
