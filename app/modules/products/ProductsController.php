<?php

namespace app\modules\products;

use app\core\Controller;
use app\modules\products\classes\Products;

class ProductsController implements Controller
{

    public function Route($data)
    {
        $jsondata = $data["JSON"];

        switch ($data["Page_key"]) {

            case 'getProducts':
                return (new Products())->getProducts();

            case 'getProductBasedURL':
                return (new Products())->getProductBasedURL();

            case 'getProducts_subscription':
                return (new Products())->getProducts_subscription();

            case 'addProduct':
                return (new Products())->addProduct($jsondata);

            case 'addProductSubscription':
                return (new Products())->addProductSubscription($jsondata);

            case 'getProductsubscription':
                return (new Products())->getProductsubscription($jsondata);

            case 'getActiveProductSubscription':
                return (new Products())->getActiveProductSubscription($jsondata);

            case 'addproductbasedfiles':
                return (new Products())->addproductbasedfiles($jsondata);


            case 'deleteProduct':
                return (new Products())->deleteProduct($jsondata);

            case 'getProductModule':
                return (new Products())->getProductModule($jsondata);

            case 'deleteProductSubscription':
                return (new Products())->deleteProductSubscription($jsondata);

            case 'getProductVersion':
                return (new Products())->getProductVersion($jsondata);
            case 'getAllProduct':
                return (new Products())->getAllProduct($jsondata);

            case 'getProductVersionBasedonProductID':
                return (new Products())->getProductVersionBasedonProductID($jsondata);

            case 'updateProductVersion':
                return (new Products())->updateProductVersion($jsondata);

            case 'deleteProductURL': //added by dev on 06/11/23
                return (new Products())->deleteProductURL($jsondata);

            case 'getProductViewLeads': //added by dev on 06/11/23
                return (new Products())->getProductViewLeads($jsondata);

            case 'updateViewLeads': //added by dev on 06/11/23
                return (new Products())->updateViewLeads($jsondata);

            case 'deleteProducViewLeads': //added by dev on 07/11/23
                return (new Products())->deleteProducViewLeads($jsondata);

            case 'getProductItplViewLeads': //added by dev on 29/11/23
                return (new Products())->getProductItplViewLeads($jsondata);

            case 'getviewirequestquotes': //added by dev on 29/11/23
                return (new Products())->getviewirequestquotes($jsondata);

            default:
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                //session_destroy();
                return array("return_code" => false, "return_data" => array("Page Key not found (Products)"));
        }
    }

    public static function Views($page)
    {

        $viewpath = "../app/modules/products/views/";

        switch ($page[1]) {

            case 'product':
                load($viewpath . "product.php");
                break;
            case 'productsubscription':
                load($viewpath . "productsubscription.php");
                break;
            case 'productversion':
                load($viewpath . "productversion.php");
                break;
            case 'managebasedfilepath':
                load($viewpath . "managebasedfilepath.php");
                break;

            case 'viewleads':
                load($viewpath . "viewleads.php"); //added by dev on 06/11/23
                break;

            case 'viewitplleads':
                load($viewpath . "viewitplleads.php"); //added by dev on 29/11/23
                break;

            case 'requestquotes':
                load($viewpath . "viewrequestquotes.php"); //added by dev on 29/11/23
                break;

            default:
                // session_destroy();
                include '404.php';
                header('HTTP/1.1 401  Unauthorized Access');
                header("Status: 401 ");
                break;
        }
    }
}
