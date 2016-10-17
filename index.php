<!DOCTYPE html>
<html lang="br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ORSON: Revista de Cinema do Centro de Artes</title>

    <!-- Link para a CSS -->
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" media="screen">
  </head>
  <body>
    <article>
      <?php
        // Começa o loop principal
        if( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <header>
          <!-- Capa da Edição -->
          <?php
            $terms = get_the_terms( $post->ID , 'edicoes');
            foreach( $terms as $term ){
              $tax = $term->taxonomy;
              $id = $term->term_id;
              $url = get_field( 'capa' , $tax.'_'.$id );
            }
          ?>
          <img src="<?php echo $url ?>" alt="" />

          <!-- Edição a que pertence o artigo -->
          <div class="edicao"><?php the_terms( $post->ID, 'edicoes' ); ?></div>
          <!-- Seção a que pertence o artigo -->
          <div class="secao"><?php the_terms( $post->ID, 'secoes' ); ?></div>
          <!-- Título do artigo -->
          <div class="title"><?php the_title(); ?></div>
          <!-- Autor(es) do artigo: roda função descrita em functions.php -->
          <div class="autor"><?php orson_authors(); ?></div>
        </header>
        <section>

          <!-- Resumo do artigo -->
          <?php
          // Se houver um resumo para mostrar
          if ( get_field('resumo') ) :
            // monte a seguinte estrutura ?>
            <div class="resumo">
              <h2>Resumo</h2>
              <div class="">
                <?php echo the_field( 'resumo' ); ?>
              </div>
            </div>
          <?php endif; ?>

          <!-- Lista de palavras-chave do artigo -->
          <?php
          // Se houver a seguinte taxonomia
          if ( has_term( '' , 'palavrasChave' ) ) :
            // Monte a seguinte estrutura  ?>
            <div class="palavras-chave">
              <?php echo get_the_term_list( $post->ID, 'palavrasChave', '<b>Palavras-Chave:</b> ', ', ', '' ); ?>
            </div>
          <?php endif; ?>

          <!-- Abstract do artigo -->
          <?php
          // Se houver um resumo para mostrar
          if ( get_field('abstract') ) :
            // monte a seguinte estrutura ?>
            <div class="abstract">
              <h2>Abstract</h2>
              <div class="">
                <?php echo the_field( 'abstract' ); ?>
              </div>
            </div>
          <?php endif; ?>

          <!-- Lista de keywords do artigo -->
          <?php
          // Se houver a seguinte taxonomia
          if ( has_term( '' , 'keywords' ) ) :
            // Monte a seguinte estrutura  ?>
            <div class="keywords">
              <?php
              $keywords = wp_get_object_terms( $post->ID , 'keywords' );
              echo '<b>Keywords</b>: ';

              foreach ( $keywords as $keyword )
                $keyword_name[] = $keyword->name;
                echo implode( ', ' , $keyword_name );
              ?>
            </div>
          <?php endif; ?>

          <!-- Conteúdo textual do artigo -->
          <div class=""><?php the_content(); ?></div>
        </section>

        <!-- Rodapé do artigo -->
        <footer>
          <?php
          // Se houver notas de rodapé para mostrar
          if ( get_field( 'notas_de_rodape' ) ) :
          // Gere a seguinte estrutura
          ?>
            <div class="notas-de-rodape">
              <h2>Notas</h2>
              <?php echo the_field( 'notas_de_rodape' ); ?>
            </div>
          <?php endif; ?>

        </footer>
      <?php endwhile; else : ?>
      	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php endif; ?>
    </article>
  </body>
</html>
