<?php

namespace App\Http\Controllers\Publics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publics\ProductsModel;
use Lang;

class ProductsController extends Controller
{

    function buildTree(array $elements, $parentId = 0)
    {
        $branch = array();
        foreach ($elements as $element) {
            if ($element->parent == $parentId) {
                $children = $this->buildTree($elements, $element->id);
                if ($children) {
                    $element->children = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
    
    public function index(Request $request)
    {
        $productsModel = new ProductsModel();
        $products = $productsModel->getProducts($request);
        $categores = $productsModel->getCategories();
        if ($request->category != null) {
            $categoryName = $productsModel->getCategoryName($request->category);
        }

        $tree = $this->buildTree($categores);
        return view('publics.products', [
            'products' => $products,
            'cartProducts' => $this->products,
            'categories' => $tree,
            'selectedCategory' => $request->category,
            'head_title' => $request->category == null ? Lang::get('seo.title_products') : $categoryName[0],
            'head_description' => $request->category == null ? Lang::get('soe.descr_products') : Lang::get('seo.descr_products_category') . $categoryName[0],
        ]);
    }

    public function productPreview(Request $request)
    {
        $productsModel = new ProductsModel();
        $product = $productsModel->getProduct($request->id);
        $categores = $productsModel->getCategories();
        $tree = $this->buildTree($categores);
        if ($product == null) {
            abort(404);
        }

        $gallery = array();
        if ($product->folder != null) {
            $dir = '../public/storage/moreImagesFolders/' . $product->folder . '/';
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    $i = 0;
                    while (($file = readdir($dh)) !== false) {
                        if (is_file($dir . $file)) {
                            $gallery[] = asset('storage/moreImagesFolders/' . $product->folder . '/' . $file);
                        }
                        $i++;
                    }
                    closedir($dh);
                }
            }
        }

        return view('publics.preview', [
            'product' => $product,
            'categories' => $tree,
            'cartProducts' => $this->products,
            'head_title' => mb_strlen($product->name) > 70 ? str_limit($product->name, 70) : $product->name,
            'head_description' => mb_strlen($product->description) > 160 ? str_limit($product->description, 160) : $product->description,
            'gallery' => $gallery
        ]);
    }

}
