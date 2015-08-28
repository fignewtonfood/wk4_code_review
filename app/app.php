<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Brand.php";
  require_once __DIR__."/../src/Store.php";

  $app = new Silex\Application();
  $app['debug'] = true;

  $server = 'mysql:host=localhost;dbname=shoes';
  $username = 'root';
  $password = 'root';
  $DB = new PDO($server, $username, $password);

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
));

  $app->get("/", function() use ($app) {
    return $app['twig']->render('index.html.twig', array('stores' => Store::getAll(), 'brands' => Brand::getAll()));
  });

  $app->get("/brands", function() use ($app) {
      return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll(), 'stores' => Store::getAll()));
  });
  //
  // $app->get("/stores", function() use ($app) {
  //     return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
  // });
  //
  // $app->post("/stores", function() use ($app) {
  //     $store = new Store($_POST['name']);
  //     $store->save();
  //     return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
  // });
  //
  // $app->get("/stores/{id}", function($id) use ($app) {
  //     $store = Store::find($id);
  //     return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
  // });
  //
  $app->post("/brands", function () use ($app) {
      $id = null;
      $brand = new Brand($_POST['brand_name'], $id, $_POST['due_date']);
      $brand->save();
      return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll(), 'stores' => Store::getAll()));
  });

  // $app->get("/brands/{id}", function ($id) use ($app) {
  //     $brand = Brand::find($id);
  //     return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
  // });
  //
  // $app->post("/delete_brands", function() use ($app) {
  //     Brand::deleteAll();
  //     return $app['twig']->render('index.html.twig');
  // });
  //
  // $app->post("/delete_stores", function() use ($app) {
  //     Store::deleteAll();
  //     return $app['twig']->render('index.html.twig');
  // });
  //
  // $app->post("/add_brands", function () use ($app){
  //    $store = Store::find($_POST['store_id']);
  //    $brand = Brand::find($_POST['brand_id']);
  //    $store->addBrand($brand);
  //    return $app['twig']->render('store.html.twig', array('store'=>$store, 'stores' => Store::getAll(), 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
  // });
  //
  // $app->post("/add_stores", function () use ($app){
  //    $store = Store::find($_POST['store_id']);
  //    $brand = Brand::find($_POST['brand_id']);
  //    $brand->addStore($store);
  //    return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'brands' => Brand::getAll(), 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
  // });

  return $app;
?>
