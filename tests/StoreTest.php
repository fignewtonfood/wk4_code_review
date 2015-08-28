<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";
    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase {

        protected function tearDown() {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function test_save() {
            //Arrange
            $store_name = "Shoes Plus";
            $test_store = new Store($store_name);

            //Act
            $test_store->save();
            $result = Store::getAll();

            //Assert
            $this->assertEquals($test_store, $result[0]);
        }

        function test_getAll() {
            //Arrange
            $store_name = "Shoes Plus";
            $store_name2 = "Foot Crazy";
            $test_store = new Store($store_name);
            $test_store->save();
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store, $test_store2], $result);
        }

        function test_deleteAll() {
            //Arrange
            $store_name = "Shoes Plus";
            $store_name2 = "Foot Crazy";
            $test_store = new Store($store_name);
            $test_store->save();
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            Store::deleteAll();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_getId() {
            //Arrange
            $store_name = "Shoes Plus";
            $test_store = new Store($store_name);
            $test_store->save();

            //Act
            $result = $test_store->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_find() {
            //Arrange
            $store_name = "Shoes Plus";
            $store_name2 = "Foot Crazy";
            $test_store = new Store($store_name);
            $test_store->save();
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            $result = Store::find($test_store->getId());

            //Assert
            $this->assertEquals($test_store, $result);
        }

        function testAddBrand() {
            //Arrange
            $store_name = "Shoes Plus";
            $test_store = new Store($store_name);
            $test_store->save();
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            //Act
            $test_store->addBrand($test_brand);

            //Assert
            $this->assertEquals($test_store->getBrands(), [$test_brand]);
        }

        function testGetBrands() {
            //Arrange
            $store_name = "Shoes Plus";
            $test_store = new Store($store_name);
            $test_store->save();
            $brand_name = "Nike";
            $test_brand = new Brand($brand_name);
            $test_brand->save();
            $brand_name2 = "Adidas";
            $test_brand2 = new Brand($brand_name2);
            $test_brand2->save();

            //Act
            $test_store->addBrand($test_brand);
            $test_store->addBrand($test_brand2);

            //Assert
            $this->assertEquals($test_store->getBrands(), [$test_brand, $test_brand2]);
        }

        function testUpdate () {
            //Arrange
            $store_name = "Shoes Plus";
            $test_store = new Store($store_name);
            $test_store->save();
            $new_store_name = "Boots and More";
            //Act
            $test_store->update($new_store_name);
            //Assert
            $this->assertEquals("Boots and More", $test_store->getName());
        }


        // function test_getStoreName() {
        //     //Arrange
        //     $store_name = "Shoes Plus";
        //     $test_Store = new Store($store_name);
        //     //Act
        //     $result = $test_Store->getStoreName();
        //     //Assert
        //     $this->assertEquals($store_name, $result);
        // }
        // function testSetStoreName()
        // {
        //     //Arrange
        //     $store_name = "Kitchen chores";
        //     $test_store = new Store($store_name);
        //     //Act
        //     $test_store->setStoreName("Home chores");
        //     $result = $test_store->getStoreName();
        //     //Assert
        //     $this->assertEquals("Home chores", $result);
        // }
        // function testDeleteStore()
        // {
        //     //Arrange
        //     $store_name = "Shoes Plus";
        //     $id = 1;
        //     $test_store = new Store($store_name, $id);
        //     $test_store->save();
        //     $store_name2 = "Foot Crazy";
        //     $id2 = 2;
        //     $test_store2 = new Store($store_name2, $id2);
        //     $test_store2->save();
        //     //Act
        //     $test_store->deleteOne();
        //     //Assert
        //     $this->assertEquals([$test_store2], Store::getAll());
        // }
        // function testDelete() {
        //     //Arrange
        //     $store_name = "Shoes Plus";
        //     $id = 1;
        //     $test_store = new Store($store_name, $id);
        //     $test_store->save();
        //     $brand_name = "Nike";
        //     $id2 = 2;
        //     $due_date = null;
        //     $test_brand = new Brand($brand_name, $id2, $due_date);
        //     $test_brand->save();
        //     //Act
        //     $test_store->addBrand($test_brand);
        //     $test_store->deleteOne();
        //     //Assert
        //     $this->assertEquals([], $test_brand->getCategories());
        // }
    }
?>
