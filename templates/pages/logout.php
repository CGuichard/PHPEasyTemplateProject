<?php
  session_destroy();
  header("Location: ".get_url_for("/"));
?>
