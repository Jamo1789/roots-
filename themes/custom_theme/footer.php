<style>
/* CSS for footer links */
/* CSS for footer links */
.list-unstyled li a {
    position: relative;
    color: rgba(0,0,0,.55);
    text-decoration: none;
}

.list-unstyled li a:hover {
    color: black;
}

/* Underline style for footer links */
.list-unstyled li a::before {
    content: "";
    position: absolute;
    display: block;
    width: 100%;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: green;
    transform: scaleX(0);
    transition: transform 0.3s ease;
}


</style>
<!-- Footer -->
<footer class="page-footer font-small bg-secondary pt-4">

  <!-- Footer Links -->
  <div class="container-fluid text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-6 mt-md-0 mt-3">

        <!-- Content -->
        <h5 class="text-uppercase">Footer Content</h5>
        <p>Here you can use rows and columns to organize your footer content.</p>

      </div>

      <div class="col-md-3 mb-md-0 mb-3">

        <!-- Links -->
        <h5 class="text-uppercase">Links</h5>

        <ul class="list-unstyled">
          <li>
            <a href="#!">Link 1</a>
          </li>
          <li>
            <a href="#!">Link 2</a>
          </li>
          <li>
            <a href="#!">Link 3</a>
          </li>
          <li>
            <a href="#!">Link 4</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© <?php echo date("Y"); ?>
    <a href="/"> companyX.com</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->