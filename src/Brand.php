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
//Get Stores from Brand method using join statement
        function getStores()
        {
//Join statement saved into returned_stores; query selects all stores columns and joins data across tables to return all matching stores that fit a specific brand id
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
                JOIN brands_stores ON (brands.id = brands_stores.brand_id)
                JOIN stores ON (brands_stores.store_id = stores.id)
                WHERE brands.id = {$this->getId()};");
            $stores = array();
            foreach ($returned_stores as $store) {
                $name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        function save() {
            $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }
//Save a brand and store at the same time to join table
        function addStore($store) {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$this->getId()}, {$store->getId()});");
        }

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

        static function find($search_id){
            $found_brand = null;
            $brands = Brand::getAll();
            foreach($brands as $brand) {
                $brand_id = $brand->getId();
                if ($brand_id == $search_id) {
                    $found_brand = $brand;
                }
            }
            return $found_brand;
        }
    }
?>
