<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php
class Block_Customer_Price_Grid extends Block_Core_Template
{
    public function __construct()
    {
        $this->setTemplate("view/customer/price/grid.php");
    }

    public function getProducts()
    {
        $productModel = Ccc::getModel('product');
        $products = $productModel->fetchAll("SELECT p.productId, p.name, p.sku, p.price as productPrice, 
                                                p.map, c.entityId, c.customerId, c.price as customerPrice 
                                                FROM product AS p 
                                                LEFT JOIN customer_price AS c 
                                                ON p.productId = c.productId");
        //$product = $product->fetchAll("SELECT * FROM product");
        return $products;
    }

    public function getPrices()
    {
        $customerId = (int)Ccc::getFront()->getRequest()->getRequest('id');
        $productModel = Ccc::getModel('Customer_Price');
        $prices = $productModel->fetchAll("SELECT productId,price 
                                            FROM customer_price 
                                            WHERE customerId = {$customerId}");
        return $prices;
    }

    public function getSalesmanPrice($price, $salesmanDiscount)
    {
        $salesmanPrice = $price * $salesmanDiscount / 100;
        $salesmanPrice = $price -$salesmanPrice;
        return $salesmanPrice;
    }

    public function getSalesmanDiscount($id)
    {
        $salesmanModel = Ccc::getModel('Salesman');
        $salesman = $salesmanModel->fetchAll("SELECT discount 
                                                FROM salesman 
                                                WHERE salesmanId = {$id}");
        foreach ($salesman as $key => $value) 
        {
            return $value->discount;
        }  
        return false; 
    }
}