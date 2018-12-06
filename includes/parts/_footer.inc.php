<?php
/**
 * The footer of the website
 *
 * PHP version 5.6.25 and up to 7.0.1
 *
 * @author Clement GUICHARD <clement.guichard1@etu.univ-orleans.fr>
 * @version 1.0
 * @package includes.parts
 * @since 1.0
 *
 */

 /*====================================================*/
?>

  <footer id="footer" class="page-footer text-center font-small wow fadeIn">
    <div class="container-fluid text-center text-md-left pt-2 pb-2">
        <div class="row m-2 mt-4">
          <section class="col-md-3">
            <h5 class="text-uppercase text-center mb-4">About us</h5>
            <div class="text-center mt-5">
              <p>
                Alii summum decus in carruchis solito altioribus et ambitioso
                vestium cultu ponentes sudant sub ponderibus lacernarum, quas
                in collis insertas cingulis ipsis adnectunt nimia subtegminum.
              </p>
            </div>
          </section>
          <section class="col-md-3">
            <h5 class="text-uppercase text-center mb-4">Quick links</h5>
            <div class="d-flex">
              <ul class="list-group list-group-flush mx-auto justify-content-center text-left">
                <?php make_footer_links($NAVBAR_LINKS) ?>
              </ul>
            </div>
          </section>
          <section class="col-md-3">
            <h5 class="text-uppercase text-center mb-4">Contact</h5>
            <ul class="list-group list-group-flush text-center">
              <li class="list-group-item">
                <p><i class="fas fa-map-marker fa-lg mr-1"></i> X Road of XXXX - XXXXX CityX</p>
              </li>
              <li class="list-group-item">
                <p><i class="fas fa-phone fa-lg mr-1"></i> +XXX XX XX XX XX</p>
              </li>
              <li class="list-group-item">
                <p><i class="fas fa-envelope fa-lg mr-1"></i><span class="font-weight-bold">XXXXXXXXX: </span><a href="mailto:xxxx@xxxxxxx.xxx">xxxx@xxxxxxx.xxx</a></p>
              </li>
            </ul>
          </section>
          <section class="col-md-3">
            <h5 class="text-uppercase text-center mb-4">BONUS SECTION</h5>
            <div class="text-center mt-5">
              <p>
                Altera urbes carbasos Paphus eadem carinae tamque municipia
                tanta Cyprus supremos externi insignis viribus Paphus carinae
                claram urbes Paphus a omnium duae supremos insignis mari Salamis
                insignis abundat usque tanta.
              </p>
            </div>
          </section>
        </div>
    </div>
    <hr class="my-2">
    <div class="pb-4">
      <a href="" target="_blank">
        <i class="fab fa-facebook mr-3"></i>
      </a>
      <a href="" target="_blank">
        <i class="fab fa-twitter mr-3"></i>
      </a>
      <a href="" target="_blank">
        <i class="fab fa-github mr-3"></i>
      </a>
      <a href="" target="_blank">
        <i class="fab fa-gitlab"></i>
      </a>
    </div>
    <div class="footer-copyright py-3">
      © 2018 Copyright:
      <span class="text-white">[CopyrightName]</span>.
      <a href="<?php url_for("/legal-notice") ?>" style="text-decoration:underline;">Look at the Legal Notice here</a>
    </div>
  </footer>
