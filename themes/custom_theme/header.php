<!DOCTYPE html>
<html>
<head>
  <?php wp_head(); ?>
  <style>
/* Force the header to the top of the screen */
header.navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    background-color: #FFFFFF !important;
    padding-top: 20px; /* Increase or decrease this value to adjust the height */
    padding-bottom: 20px; /* Increase or decrease this value to adjust the height */
}
header.navbar .navbar-brand {
    margin-left: 12px; /* Adjust the value as needed */
}

   
  .page_item a {
    color: black;
    text-decoration: none;
  }
  .nav-item {
  margin-left: 15px; /* Adjust the margin value as needed */
}

li a {
  position: relative;
  color: #000;
  text-decoration: none;
}

li a:hover {
  color: black;
}
li a::before {
  content: "";
  position: absolute;
  display: block;
  width: 100%;
  height: 2px;
  bottom: 0;
  left: 0;
  background-color: black;
  transform: scaleX(0);
  transition: transform 0.3s ease;
}

    /* Additional styles for "it-tuki" section */
    .it-tuki {
      text-align: right;
      margin-right: 15px; /* Adjust the right margin as needed */
      margin-top: 10px; /* Align with the existing content */
    }
</style>
</head>
<body>
<header class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <?php
            $menu_items = wp_get_nav_menu_items('header-menu'); // Replace 'header-menu' with your menu location.

            if ($menu_items) {
              echo '<ul class="navbar-nav">';

              foreach ($menu_items as $menu_item) {
                echo '<li class="nav-item d-flex align-items-center"><a class="nav-link" href="' . esc_url($menu_item->url) . '">' . esc_html($menu_item->title) . '</a></li>';
              }

              echo '<li class="nav-item">';
              echo '<li class="nav-item d-flex align-items-center">';
              echo '<img src="' . esc_url(get_theme_file_uri('walkietalkie.svg')) . '" alt="Walkie Talkie" width="20" height="20" class="mr-2">';
              echo '<a class="nav-link">it-tuki</a>';
              echo '</li>';

              echo '</ul>';
            } else {
              // Handle the case when no menu items are found.
              echo '<p>No menu items found.</p>';
            }
            ?>
    </div>
  </div>
</header>

</body>
</html>
