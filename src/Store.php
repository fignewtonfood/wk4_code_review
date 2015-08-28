<?php

    require_once "Brand.php";

    class Store {

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

        // function getBrands() {
        //     $query = $GLOBALS['DB']->query("SELECT brand_id FROM brands_stores WHERE store_id = {$this->getId()};");
        //     $brand_ids = $query->fetchAll(PDO::FETCH_ASSOC);
        //     $brands = Array();
        //     foreach($brand_ids as $id) {
        //         $brand_id = $id['brand_id'];
        //         $result = $GLOBALS['DB']->query("SELECT * FROM brands WHERE id = {$brand_id};");
        //         $returned_brand = $result->fetchAll(PDO::FETCH_ASSOC);
        //         $brand_name = $returned_brand[0]['brand_name'];
        //         $id = $returned_brand[0]['id'];
        //         $due_date = $returned_brand[0]['due_date'];
        //         $new_brand = new Brand($brand_name, $id, $due_date);
        //         array_push($brands, $new_brand);
        //     }
        //     return $brands;
        // }

        function save() {
            $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        // function update($new_name) {
        //     $GLOBALS['DB']->exec("UPDATE stores set name = '{$new_name}' WHERE id = {$this->getId()};");
        //     $this->setName($new_name);
        // }
        //
        // function deleteOne()
        // {
        //     $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
        //     $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE store_id = {$this->getId()};");
        // }
        //
        // function addBrand($brand) {
        //     $GLOBALS['DB']->exec("INSERT INTO brands_stores (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");
        // }

        static function getAll() {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach($returned_stores as $store) {
                $name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        // static function deleteAll() {
        //     $GLOBALS['DB']->exec("DELETE FROM stores;");
        // }

        // static function find($search_id){
        //     $found_store = null;
        //     $stores = Store::getAll();
        //     foreach($stores as $store) {
        //         $store_id = $store->getId();
        //         if ($store_id == $search_id) {
        //             $found_store = $store;
        //         }
        //     }
        //     return $found_store;
        // }
    }
?>
