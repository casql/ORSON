<?php
  // Documento de funções do tema

  //
  // Função que faz output do(s) autor(es) quando houver.
  function orson_authors() {
    if( class_exists('coauthors_plus') ) {
      $co_authors = get_coauthors();
      foreach ( $co_authors as $co_author ) {
        echo '<div>';
        echo '<b>'.$co_author->display_name.'</b>';
        echo '<p>'.$co_author->description.'</p>';
        echo '</div>';
      }
    }
    else {
      echo "Sem autores para este post!";
    }
  }


?>
