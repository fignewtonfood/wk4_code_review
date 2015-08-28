<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    $app = new Silex\Application();
    $app['debug'] = true;
// Server login
    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));
// Allows use of _method input
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();
//creates a route to homepage and renders index
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });
//creates a route to brands and renders brands page storing 'brands' as an index to all brands so that twig can use them
    $app->get("/brands", function() use ($app) {
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });
//creates a route to stores and renders Stores page storing 'stores' as an index to all stores so that twig can use them
    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });
//creates a route to brands upon adding a brand and renders brands storing 'brands' as an index to all brands so that twig can use them
    $app->post("/brands", function () use ($app) {
        $brand = new Brand($_POST['brand_name']);
        $brand->save();
        return $app['twig']->render('brands.html.twig', array('brands' => Brand::getAll()));
    });
//creates a route to stores upon adding a store and renders stores storing 'stores' as an index to all stores so that twig can use them
    $app->post("/stores", function() use ($app) {
        $store = new Store($_POST['name']);
        $store->save();
        return $app['twig']->render('stores.html.twig', array('stores' => Store::getAll()));
    });
//creates a route to a brand's page upon clicking the brand's name on the brands page, the brand referenced in the url and all of their stores are associated with indices so that twig may use them
    $app->get("/brands/{id}", function ($id) use ($app) {
        $brand = Brand::find($id);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });
//creates a route to a store's page upon clicking the store's name on the stores page, the store referenced in the url and all of their brands are associated with indices so that twig may use them
    $app->get("/stores/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store.html.twig', array('store' => $store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });
//creates a route to delete_brands upon clicking deleteall and renders brands page, the list of all brands is not passed through since that list is now empty
    $app->post("/delete_brands", function() use ($app) {
        Brand::deleteAll();
        return $app['twig']->render('brands.html.twig');
    });
//creates a route to delete_stores upon clicking deleteall and renders stores page, the list of all stores is not passed through since that list is now empty
    $app->post("/delete_stores", function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render('stores.html.twig');
    });
//creates a route to add_brands upon adding a new brand to the stores data in join table, then renders that store's page, the store referenced in the url and all of their brands are associated with indices so that twig may use them
    $app->post("/add_brands", function () use ($app){
        $store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $store->addBrand($brand);
        return $app['twig']->render('store.html.twig', array('store'=>$store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });
//creates a route to add_stores upon adding a new store to the brands data in join table, then renders that brand's page, the store referenced in the url and all of their stores are associated with indices so that twig may use them
    $app->post("/add_stores", function () use ($app){
        $store = Store::find($_POST['store_id']);
        $brand = Brand::find($_POST['brand_id']);
        $brand->addStore($store);
        return $app['twig']->render('brand.html.twig', array('brand' => $brand, 'stores' => $brand->getStores(), 'all_stores' => Store::getAll()));
    });
//creates a route to stores_edit page and rendering store_edit storing "store" as an index to the store being edited
    $app->get("/stores/{id}/edit", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('store_edit.html.twig', array('store' => $store));
    });
//creates a route to the store's page upon updating the store's name and renders that store's page storing required fields as indices to relevant fields so that twig can use them
    $app->patch("/stores/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $store = Store::find($id);
        $store->update($name);
        return $app['twig']->render('store.html.twig', array('store'=>$store, 'brands' => $store->getBrands(), 'all_brands' => Brand::getAll()));
    });
//creates a route to the store's page upon deleting the store's object and renders index
    $app->delete("/stores/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->deleteOne();
        return $app['twig']->render('index.html.twig');
    });
  return $app;
?>
