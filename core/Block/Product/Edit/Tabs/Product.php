<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php 
class Block_Product_Edit_Tabs_Product extends Block_Core_Template
{
	public function __construct()
	{
		$this->setTemplate('view/product/edit/tabs/product.php');
	}

	public function getProduct()
	{
		return Ccc::getRegistry('product');
	}

	public function setEdit($edit)
    {
        $this->edit = $edit;
        return $this;
    }

    public function getEdit()
    {
        return $this->edit;
    }

    public function getSaveUrl()
	{
		return $this->getUrl('save','product');
	}
}