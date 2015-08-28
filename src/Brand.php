<?php

    require_once "Store.php";

    class Brand {

        private $name;
        private $id;

        function __construct($name, $id = null) {
            $this->name = $name;
            $this->id = $id;
        }

        function setName($new_name) {
            $this->name = (string) $new_name;
        }

        function getName() {
            return $this->name;
        }

        function getId() {
            return $this->id;
        }

        // function getStores() {
        //     $query = $GLOBALS['DB']->query("SELECT store_id FROM stores_brands WHERE brand_id = {$this->getId()};");
        //     $store_ids = $query->fetchAll(PDO::FETCH_ASSOC);
        //     $stores = Array();
        //     foreach($store_ids as $id) {
        //         $store_id = $id['store_id'];
        //         $result = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$store_id};");
        //         $returned_store = $result->fetchAll(PDO::FETCH_ASSOC);
        //         $store_name = $returned_store[0]['store_name'];
        //         $id = $returned_store[0]['id'];
        //         $due_date = $returned_store[0]['due_date'];
        //         $new_store = new Store($store_name, $id, $due_date);
        //         array_push($stores, $new_store);
        //     }
        //     return $stores;
        // }

        function save() {
            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        // function update($new_name) {
        //     $GLOBALS['DB']->exec("UPDATE brands set name = '{$new_name}' WHERE id = {$this->getId()};");
        //     $this->setName($new_name);
        // }
        //
        // function deleteOne()
        // {
        //     $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
        //     $GLOBALS['DB']->exec("DELETE FROM stores_brands WHERE brand_id = {$this->getId()};");
        // }
        //
        // function addStore($store) {
        //     $GLOBALS['DB']->exec("INSERT INTO stores_brands (brand_id, store_id) VALUES ({$this->getId()}, {$store->getId()});");
        // }

        static function getAll() {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();
            foreach($returned_brands as $brand) {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        // static function find($search_id){
        //     $found_brand = null;
        //     $brands = Brand::getAll();
        //     foreach($brands as $brand) {
        //         $brand_id = $brand->getId();
        //         if ($brand_id == $search_id) {
        //             $found_brand = $brand;
        //         }
        //     }
        //     return $found_brand;
        // }
    }
?>
