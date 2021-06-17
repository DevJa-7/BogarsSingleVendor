<?php

namespace App;

use App\Models\Publics\ProductsModel;

/**
 * This class manage shopping cart of users
 *
 * @author kiro
 */
class Cart
{
    /*
     * 1 month expire time
     */

    private $cookieExpTime = 2678400;
    public $countProducts = 0;
    public $totalPrice = 0;

    public function addProduct($id, $quantity, $product_size)
    {
        $productsModel = new ProductsModel();
        if (!isset($_SESSION['laraCart'])) {
            $_SESSION['laraCart'] = array();
        }
        $item['id'] = (int) $id;
        $item['product_size'] = $product_size;
        for ($i = 1; $i <= $quantity; $i++) {
            $_SESSION['laraCart'][] = $item;
        }
        setcookie('laraCart', serialize($_SESSION['laraCart']), $this->cookieExpTime);
    }

    public function removeProductQuantity($id)
    {
        if (($key = $this->searchForId((int)$id, $_SESSION['laraCart'])) !== false){
            unset($_SESSION['laraCart'][$key]);
        }
    }

    public function removeProduct($id)
    {
        $count = count(array_keys(array_column($_SESSION['laraCart'], 'id'), $id));
        $i = 1;
        do {
            if (($key = $this->searchForId((int)$id, $_SESSION['laraCart'])) !== false){
                unset($_SESSION['laraCart'][$key]);
            }
            $i++;
        } while ($i <= $count);
        setcookie('laraCart', serialize($_SESSION['laraCart']), $this->cookieExpTime);
    }

    public function changeSize($id, $size)
    {
        if (($keys = $this->searchForIds((int)$id, $_SESSION['laraCart'])) !== false){
            foreach ($keys as $key) {
                $_SESSION['laraCart'][$key]['product_size'] = $size;
            }
        }
        setcookie('laraCart', serialize($_SESSION['laraCart']), $this->cookieExpTime);
    }

    public function clearCart()
    {
        unset($_SESSION['laraCart']);
        setcookie('laraCart', null, -1, '/');
    }

    private function getCartProductsIds()
    {
        $products = array();
        if (!isset($_SESSION['laraCart']) || empty($_SESSION['laraCart'])) {
            if (isset($_COOKIE['laraCart']) && $_COOKIE['laraCart'] == null && !empty($_COOKIE['laraCart'])) {
                $_SESSION['laraCart'] = unserialize($_COOKIE['laraCart']);
            }
        } else {
            $products = array_column($_SESSION['laraCart'], 'id');
        }
        return $products;
    }

    private function getCartProductsSizes()
    {
        $sizes = array();
        if (!isset($_SESSION['laraCart']) || empty($_SESSION['laraCart'])) {
            if (isset($_COOKIE['laraCart']) && $_COOKIE['laraCart'] == null && !empty($_COOKIE['laraCart'])) {
                $_SESSION['laraCart'] = unserialize($_COOKIE['laraCart']);
            }
        } else {
            $sizes = array_column($_SESSION['laraCart'], 'product_size', 'id');
        }
        return $sizes;
    }

    public function makeProductSizeArray($product) {
        $product_sizes = [];
        if ($product->size_xs == 1) array_push($product_sizes, "XS");
        if ($product->size_s == 1) array_push($product_sizes, "S");
        if ($product->size_m == 1) array_push($product_sizes, "M");
        if ($product->size_l == 1) array_push($product_sizes, "L");
        if ($product->size_xl == 1) array_push($product_sizes, "XL");
        if ($product->size_xxl == 1) array_push($product_sizes, "XXL");
        if ($product->size_xxxl == 1) array_push($product_sizes, "XXXL");

        return $product_sizes;
    }

    public function getCartProducts()
    {
        $productsModel = new ProductsModel();
    
        $products_ids = $this->getCartProductsIds();
        $products_sizes = $this->getCartProductsSizes();
        $unique_ids = array_unique($products_ids);

        $products = [];
        $this->countProducts = 0;
        $this->totalPrice = 0;
        if (!empty($products_ids)) {
            $products = $productsModel->getProductsWithIds($unique_ids);
            foreach ($products as $product) {
                $counts = array_count_values($products_ids);
                $numAddedToCart = $counts[$product->id];
                $product->num_added = $numAddedToCart;
                $product->product_size = $products_sizes[$product->id];
                $product->size_array = $this->makeProductSizeArray($product);
                $this->countProducts += $product->num_added;
                $this->totalPrice += (float)$product->price * $product->num_added; 
            }
        }
        return $products;
    }

    private function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['id'] === $id) {
                return $key;
            }
        }
        return false;
    }

    private function searchForIds($id, $array) {
        $keys = [];
        foreach ($array as $key => $val) {
            if ($val['id'] === $id) {
                array_push($keys, $key);
            }
        }

        if (empty($keys)) {
            return false;
        } else {
            return $keys;
        }
     }

    public function getCartHtmlWithProducts()
    {
        $products = $this->getCartProducts();

        $sum = 0;
        if (!empty($products)) {
            $sum = 0;
            ob_start();
            include '../resources/views/publics/cartHtml.php';
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        } else {
            return $products;
        }
    }

    public function getCartHtmlWithProductsForCheckoutPage()
    {
        $products = $this->getCartProducts();

        $sum = 0;
        if (!empty($products)) {
            $sum = 0;
            ob_start();
            include '../resources/views/publics/cartHtmlForCheckoutPage.php';
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        } else {
            return $products;
        }
    }

}
