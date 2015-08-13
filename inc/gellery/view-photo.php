<?php


//Добавляем фотографии на страницу объекта
function add_photo_to_objects($content){
  global $post;

  $attachments = new Attachments( 'my_attachments' ); /* pass the instance name */

  if( $attachments->exist() ) :

    ob_start();
    ?>
      <section class="object-photo-s">
        <h1>Фотографии</h1>


        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <?php
            $attachments = new Attachments( 'my_attachments' ); /* pass the instance name */
            $i = 0;
            while( $attachment = $attachments->get() ) :
            ?>
              <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" <?php if($i == 0 ) echo 'class="active"' ?>></li>
            <?php
            $i++;
            endwhile;
            ?>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <?php
            $attachments = new Attachments( 'my_attachments' ); /* pass the instance name */
            $i = 0;
            while( $attachment = $attachments->get() ) :
            ?>
              <div class="item <?php if($i == 0) echo "active"?>">
                <?php echo wp_get_attachment_image( $attachment->id, 'full' ); ?>
              </div>
            <?php
            $i++;
            endwhile;
            ?>
          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Назад</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Далее</span>
          </a>
        </div>
        <ul>
          <?php while( $attachment = $attachments->get() ) : ?>
            <li>
              <pre><?php print_r( $attachment ); ?></pre>
            </li>
          <?php endwhile; ?>
        </ul>
      </section>
    <?php
    $html = ob_get_contents();
    ob_get_clean();
    $content .= $html;
  endif;


  return $content;
}
add_filter('the_content', 'add_photo_to_objects');
