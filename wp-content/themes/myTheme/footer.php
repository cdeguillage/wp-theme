      <!-- FOOTER -->
      <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>© 2017-2018 Company, Inc.
            <?php 
              $items = wp_get_nav_menu_items("main-footer");
              foreach($items as $item) { ?>&nbsp;&middot;&nbsp;<a href="<?= $item->url; ?>"><?= $item->title; ?></a><?php }
            ?>
        </p>
      </footer>
    </main>

    <?php wp_footer(); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="/wp-theme/wp-content/themes/myTheme/assets/js/jquery-3.3.1.min.js"></script> -->
    <!-- <script src="/wp-theme/wp-content/themes/myTheme/assets/js/popper.min.js"></script> -->
    <!-- <script src="/wp-theme/wp-content/themes/myTheme/assets/js/bootstrap.min.js"></script> -->
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <!-- <script src="/wp-theme/wp-content/themes/myTheme/assets/js/holder.min.js"></script> -->
  

<svg xmlns="http://www.w3.org/2000/svg" width="500" height="500" viewBox="0 0 500 500" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs><style type="text/css"></style></defs><text x="0" y="25" style="font-weight:bold;font-size:25pt;font-family:Arial, Helvetica, Open Sans, sans-serif">500x500</text></svg></body></html>

