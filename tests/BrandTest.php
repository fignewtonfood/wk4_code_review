<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";
    require_once "src/Store.php";
    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase {

        protected function tearDown() {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function test_save() {
            //Arrange
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name);

            //Act
            $test_brand->save();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals($test_brand, $result[0]);
        }

        function test_getAll() {
            //Arrange
            $brand_name = "Nike";
            $brand_name2 = "Adidas";
            $test_brand = new Brand($brand_name);
            $test_brand->save();
            $test_brand2 = new Brand($brand_name2);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function test_deleteAll() {
            //Arrange
            $brand_name = "Nike";
            $brand_name2 = "Adidas";
            $test_brand = new Brand($brand_name);
            $test_brand->save();
            $test_brand2 = new Brand($brand_name2);
            $test_brand2->save();

            //Act
            Brand::deleteAll();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_getId() {
            //Arrange
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            //Act
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_find() {
            //Arrange
            $brand_name = "Nike";
            $brand_name2 = "Adidas";
            $test_brand = new Brand($brand_name);
            $test_brand->save();
            $test_brand2 = new Brand($brand_name2);
            $test_brand2->save();

            //Act
            $result = Brand::find($test_brand->getId());

            //Assert
            $this->assertEquals($test_brand, $result);
        }

        function testAddStore() {
            //Arrange
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name);
            $test_brand->save();
            $store_name = "Shoes Plus";
            $test_store = new Store($store_name);
            $test_store->save();

            //Act
            $test_brand->addStore($test_store);

            //Assert
            $this->assertEquals($test_brand->getStores(), [$test_store]);
        }

        function testGetStores() {
            //Arrange
            $brand_name = "Adidas";
            $test_brand = new Brand($brand_name);
            $test_brand->save();
            $store_name = "Shoes Plus";
            $test_store = new Store($store_name);
            $test_store->save();
            $store_name2 = "Foot Crazy";
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            $test_brand->addStore($test_store);
            $test_brand->addStore($test_store2);

            //Assert
            $this->assertEquals($test_brand->getStores(), [$test_store, $test_store2]);
        }
    }
?>
