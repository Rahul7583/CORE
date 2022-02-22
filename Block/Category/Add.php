<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php

class Block_Category_Add extends Block_Core_Template
{

  public function __construct()
  {
    $this->setTemplate('view/Category/add.php');
  }

  public function getCategoryData()
  {
  	$categoryModel = Ccc::getModel('Category');
  	$category = $categoryModel->fetchRow();
  }

}