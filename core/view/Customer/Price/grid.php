<?php $id = Ccc::getFront()->getRequest()->getRequest('salesmanId');?>
<?php $salesmanDiscount = $this->getSalesmanDiscount($id) ?>
<?php $products = $this->getProducts(); ?>
<?php $prices = $this->getPrices(); ?>
<form action="<?php echo $this->getUrl('save','Customer_Price',['salesmanId' => $id]) ?>" method="post">
    <input type="submit" value="save">
    <table border="1" width="100%">
        <tr>
            <th>Product Id</th>
            <th>Product Name</th>
            <th>SKU</th>
            <th>MRP</th>
            <th>Salesman Price</th>
            <th>Customer Price</th>
        </tr>
        <?php if(!$products): ?>
            <tr>
                <td colspacing = "6">No Records Available</td>
            </tr>
        <?php else: ?>
        <?php foreach($products as $product): ?>
        <tr>
            <td><?php echo $product->productId ?> <input type="number" name="price[<?php echo $product->productId ?>]" hidden> </td>
            <td><?php echo $product->name ?></td>
            <td><?php echo $product->sku ?></td>
            <td><?php echo $product->productPrice ?></td>
            <td><?php echo $salesmanDiscount = $this->getSalesmanPrice($product->productPrice, $salesmanDiscount); ?></td>
            <td>
                <input type="number" name="product[<?php if($product->entityId){echo 'exist';} 
                    else{echo 'new';}?>]
                    [<?php if($product->entityId){echo $product->entityId;} 
                            else{echo $product->productId;} ?>]" min="<?php echo $salesmanDiscount; ?>" max="<?php echo $product->productPrice; ?>"  value="<?php echo $product->customerPrice ?>">
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</form>