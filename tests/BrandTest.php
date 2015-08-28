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

        // protected function tearDown() {
        //     Brand::deleteAll();
        //     Store::deleteAll();
        // }

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

        // function test_getBrandName() {
        //     //Arrange
        //     $brand_name = "Work stuff";
        //     $test_Brand = new Brand($brand_name);
        //     //Act
        //     $result = $test_Brand->getBrandName();
        //     //Assert
        //     $this->assertEquals($brand_name, $result);
        // }
        // function testSetBrandName()
        // {
        //     //Arrange
        //     $brand_name = "Kitchen chores";
        //     $test_brand = new Brand($brand_name);
        //     //Act
        //     $test_brand->setBrandName("Home chores");
        //     $result = $test_brand->getBrandName();
        //     //Assert
        //     $this->assertEquals("Home chores", $result);
        // }
        // function test_getId() {
        //     //Arrange
        //     $brand_name = "Work stuff";
        //     $id = 1;
        //     $test_brand = new Brand($brand_name, $id);
        //     //Act
        //     $result = $test_brand->getId();
        //     //Assert
        //     $this->assertEquals(1, $result);
        // }
        // function testUpdate () {
        //     //Arrange
        //     $brand_name = "Work stuff";
        //     $id = 1;
        //     $test_brand = new Brand($brand_name, $id);
        //     $test_brand->save();
        //     $new_brand_name = "Home stuff";
        //     //Act
        //     $test_brand->update($new_brand_name);
        //     //Assert
        //     $this->assertEquals("Home stuff", $test_brand->getBrandName());
        // }
        // function testDeleteBrand()
        // {
        //     //Arrange
        //     $brand_name = "Work stuff";
        //     $id = 1;
        //     $test_brand = new Brand($brand_name, $id);
        //     $test_brand->save();
        //     $brand_name2 = "Home stuff";
        //     $id2 = 2;
        //     $test_brand2 = new Brand($brand_name2, $id2);
        //     $test_brand2->save();
        //     //Act
        //     $test_brand->deleteOne();
        //     //Assert
        //     $this->assertEquals([$test_brand2], Brand::getAll());
        // }
        // function test_getAll() {
        //     //Arrange
        //     $brand_name = "Work stuff";
        //     $brand_name2 = "Home stuff";
        //     $id = 1;
        //     $id2 = 2;
        //     $test_brand = new Brand($brand_name, $id);
        //     $test_brand->save();
        //     $test_brand2 = new Brand($brand_name2, $id2);
        //     $test_brand2->save();
        //     //Act
        //     $result = Brand::getAll();
        //     //Assert
        //     $this->assertEquals([$test_brand, $test_brand2], $result);
        // }
        // function test_deleteAll() {
        //     //Arrange
        //     $brand_name = "Wash the dog";
        //     $id1 = 1;
        //     $brand_name2 = "Home stuff";
        //     $id2 = 2;
        //     $test_brand = new Brand($brand_name, $id1);
        //     $test_brand->save();
        //     $test_brand2 = new Brand($brand_name2, $id2);
        //     $test_brand2->save();
        //     //Act
        //     Brand::deleteAll();
        //     $result = Brand::getAll();
        //     //Assert
        //     $this->assertEquals([], $result);
        // }
        // function test_find() {
        //     //Arrange
        //     $brand_name = "Wash the dog";
        //     $id1 = 1;
        //     $brand_name2 = "Home stuff";
        //     $id2 = 2;
        //     $test_brand = new Brand($brand_name, $id1);
        //     $test_brand->save();
        //     $test_brand2 = new Brand($brand_name2, $id2);
        //     $test_brand2->save();
        //     //Act
        //     $result = Brand::find($test_brand->getId());
        //     //Assert
        //     $this->assertEquals($test_brand, $result);
        // }
        // function testAddStore() {
        //     //Arrange
        //     $brand_name = "Work stuff";
        //     $id1 = 1;
        //     $test_brand = new Brand($brand_name, $id1);
        //     $test_brand->save();
        //     $store_name = "File reports";
        //     $id2 = 2;
        //     $due_date = null;
        //     $test_store = new Store($store_name, $id2, $due_date);
        //     $test_store->save();
        //     //Act
        //     $test_brand->addStore($test_store);
        //     //Assert
        //     $this->assertEquals($test_brand->getStores(), [$test_store]);
        // }
        // function testGetStores() {
        //     //Arrange
        //     $brand_name = "Home stuff";
        //     $id1 = 1;
        //     $test_brand = new Brand($brand_name, $id1);
        //     $test_brand->save();
        //     $store_name = "Wash the dog";
        //     $id2 = 2;
        //     $due_date = null;
        //     $test_store = new Store($store_name, $id2, $due_date);
        //     $test_store->save();
        //     $store_name2 = "Take out the trash";
        //     $id3 = 3;
        //     $test_store2 = new Store($store_name2, $id3, $due_date);
        //     $test_store2->save();
        //     //Act
        //     $test_brand->addStore($test_store);
        //     $test_brand->addStore($test_store2);
        //     //Assert
        //     $this->assertEquals($test_brand->getStores(), [$test_store, $test_store2]);
        // }
        // function testDelete() {
        //     //Arrange
        //     $brand_name = "Work stuff";
        //     $id = 1;
        //     $test_brand = new Brand($brand_name, $id);
        //     $test_brand->save();
        //     $store_name = "File reports";
        //     $id2 = 2;
        //     $due_date = null;
        //     $test_store = new Store($store_name, $id2, $due_date);
        //     $test_store->save();
        //     //Act
        //     $test_brand->addStore($test_store);
        //     $test_brand->deleteOne();
        //     //Assert
        //     $this->assertEquals([], $test_store->getCategories());
        // }
    }
?>
