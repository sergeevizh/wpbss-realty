<?php
/*
Plugin Name: Данные объектов
Description: Выводит данные объектов на страницах
Version: 1
*/




//Добавляем особенности на страницу объекта
function add_features_property_s($content){
  global $post;

  ob_start();
  ?>
    <section class="features_object">

    </section>
  <?php
  $html = ob_get_contents();
  ob_get_clean();
  return $content . $html;
}
add_filter('the_content', 'add_features_property_s');




//Выводим данные карты если есть
function add_maps_property_s($content){
  global $post;

  $location = get_field('address');
  if($location){
    ob_start();
    ?>
      <section class="maps-object-s">
        <header>
          <h1>Карта</h1>
        </header>
        <div class="g-maps">
          <?php
            if( !empty($location) ):
              echo do_shortcode('[su_gmap address="' . $location['lat'] . ' ' .$location['lng'] . '"]');
            endif;
          ?>
        </div>
      </section>
    <?php
    $html = ob_get_contents();
    ob_get_clean();
    $content .= $html;
  }

  return $content;

} add_filter('the_content', 'add_maps_property_s');






//Выводим метаданные объекта если есть
function add_meta_property_s($content){
  global $post;

  $location = get_field('address');
  $cost = get_field('sum');

  ob_start();
  ?>
    <section class="meta">
      <div class="meta-hostel">
        <p><span class="glyphicon glyphicon-barcode"></span> <?php echo $post->ID; ?></p>
        <?php if(!empty($location)): ?>
          <p><span class="glyphicon glyphicon-map-marker"></span> <?php echo $location["address"]; ?></p>
        <?php endif; ?>
        <?php if(!empty($cost)): ?>
          <p><span class="glyphicon glyphicon-rub"></span> <?php echo $cost; ?></p>
        <?php endif; ?>
      </div>
    </section>

  <?php
  $html = ob_get_contents();
  ob_get_clean();

  return $html . $content;

}
add_filter('the_content', 'add_meta_property_s');





//Добавляем контактные данные на страницу объекта
function add_contacts_property_s($content){
  global $post;

  $agent = get_field('agent');
  $agent = $agent[0];

  $phone = get_field('tel_number', $agent->ID);

  //var_dump($agent);

  if(!empty($agent)):
    ob_start();
    //var_dump($agent);
    ?>
      <section class="object-contacts">
        <header>
          <h1>Контакты</h1>
        </header>
          <p><span class="glyphicon glyphicon-user"></span> <?php echo $agent->post_title; ?></p>
          <?php if(!empty($phone)): ?>
            <p><span class="glyphicon glyphicon-earphone"></span> <?php echo $phone; ?></p>
          <?php endif; ?>
      </section>
    <?php
    $html = ob_get_contents();
    ob_get_clean();
    $content .= $html;
  endif;

  return $content;
}
add_filter('the_content', 'add_contacts_property_s');
