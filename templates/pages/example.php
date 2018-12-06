<?php
  // PHPEasyTemplate::lock_log(); // Tell that the page is only accessible if connected
  // PHPEasyTemplate::lock_unlog(); // Tell that the page is only accessible if you are not connected
  $PAGE_TITLE = "Example";
  $PAGE_SECTION = "Example";
  $JARALLAX = false;
  $PAGE_CONTENT = "Example of page";
?>

<?php ob_start(); ?>
  <meta name="keywords" content="Template, PHP, Example">
<?php $metas_content = ob_get_clean(); ?>

<?php ob_start(); ?>
  <?php css("css/example.css") ?>
<?php $css_content = ob_get_clean(); ?>

<?php ob_start(); ?>
  <section class="section white-section text-center">
    <h1 class="h1">BASE TEMPLATE</h1>
    <?php $PHP_EASY_TEMPLATE->display() ?>
  </section>
  <section class="section blue-section text-center">
    <h1 class="h1">BASE TEMPLATE</h1>
    <?php $PHP_EASY_TEMPLATE->display() ?>
  </section>
  <section class="section-parallax" style="background-image: url('<?php static_img_path('backgrounds/bg1.jpg') ?>')">
    <div class="section white-parallax text-center">
      <h1 class="h1 animated fadeIn">Test 1</h1>
      <p class="paragraph text-justify">Latius iam disseminata licentia onerosus bonis omnibus Caesar nullum post haec adhibens modum orientis latera cuncta vexabat nec honoratis parcens nec urbium primatibus nec plebeiis.</p>
      <p class="paragraph text-justify">Omitto iuris dictionem in libera civitate contra leges senatusque consulta; caedes relinquo; libidines praetereo, quarum acerbissimum extat indicium et ad insignem memoriam turpitudinis et paene ad iustum odium imperii nostri, quod constat nobilissimas virgines se in puteos abiecisse et morte voluntaria necessariam turpitudinem depulisse. Nec haec idcirco omitto, quod non gravissima sint, sed quia nunc sine teste dico.</p>
    </div>
  </section>
  <section class="section-parallax" style="background-image: url('<?php static_img_path('backgrounds/bg2.jpg') ?>')">
    <div class="section light-blue-parallax text-center">
      <h1 class="h1 animated fadeIn">Test 2</h1>
      <p class="text-center">Et olim licet otiosae sint tribus pacataeque centuriae et nulla suffragiorum certamina set Pompiliani redierit securitas temporis, per omnes tamen quotquot sunt partes terrarum, ut domina suscipitur et regina et ubique patrum reverenda cum auctoritate canities populique Romani nomen circumspectum et verecundum.</p>
    </div>
  </section>
  <section class="section-parallax" style="background-image: url('<?php static_img_path('backgrounds/bg3.jpg') ?>')">
    <div class="section blue-parallax text-center">
      <h1 class="h1 animated fadeIn">Test 3</h1>
      <p class="text-left">Et est admodum mirum videre plebem innumeram mentibus ardore quodam infuso cum dimicationum curulium eventu pendentem. haec similiaque memorabile nihil vel serium agi Romae permittunt. ergo redeundum ad textum.</p>
      <p class="text-right">Quam ob rem cave Catoni anteponas ne istum quidem ipsum, quem Apollo, ut ais, sapientissimum iudicavit; huius enim facta, illius dicta laudantur. De me autem, ut iam cum utroque vestrum loquar, sic habetote.</p>
    </div>
  </section>
<?php $page_content = ob_get_clean(); ?>

<?php ob_start(); ?>
  <!-- Put your modals here -->
<?php $modals_content = ob_get_clean(); ?>

<?php ob_start(); ?>
  <?php script("js/example.js") ?>
<?php $scripts_content = ob_get_clean(); ?>

<?php require_once( template("base.php") ); ?>
