<?php Ccc::loadClass('Block_Core_Grid'); ?>
<?php
class Block_Vendor_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		//$this->setTemplate('view/vendor/grid.php');
	}

	public function getEditUrl($vendor)
	{
		return $this->getUrl('edit', 'vendor', ['id' => $vendor->vendorId]);
	}

	public function getDeleteUrl($vendor)
	{
		return $this->getUrl('delete', 'vendor', ['id' => $vendor->vendorId]);
	}

	public function prepareCollections()
	{
		/*$vendors = $this->getVendorData();
        foreach ($vendors as &$vendor) 
        {
            $vendorAddress = $vendor->getAddress()->getData();
            $vendor->setData($vendorAddress);
        }
        $this->setCollection($vendors);
        return $this;*/
		$this->setCollection($this->getVendorData());
	}
	
	public function prepareColumns()
	{
		$this->addColumn([
			'title' => 'VendorId',
			'type' => 'int'
		],'vendorId');
		$this->addColumn([
			'title' => 'First Name',
			'type' => 'varchar'
		],'firstName');
		$this->addColumn([
			'title' => 'Last Name',
			'type' => 'varchar'
		],'lastName');
		$this->addColumn([
			'title' => 'Email',
			'type' => 'varchar'
		],'email');
		$this->addColumn([
			'title' => 'Mobile',
			'type' => 'int'
		],'mobile');
		$this->addColumn([
			'title' => 'Status',
			'type' => 'tinyint'
		],'status');

		$this->addColumn([
			'title' => 'Address',
			'type' => 'varchar'
		],'address');
		$this->addColumn([
			'title' => 'postalCode',
			'type' => 'int'
		],'postalCode');
		$this->addColumn([
			'title' => 'City',
			'type' => 'varchar'
		],'city');
		$this->addColumn([
			'title' => 'State',
			'type' => 'vrchar'
		],'state');
			$this->addColumn([
			'title' => 'Country',
			'type' => 'varchar'
		],'country');
		$this->addColumn([
			'title' => 'Created Date',
			'type' => 'datetime'
		],'createdDate');
		$this->addColumn([
			'title' => 'Updated Date',
			'type' => 'datetime'
		],'updatedDate');

		return $this;
	}

	public function prepareActions()
	{
		$this->addAction([
			'title' => 'edit',
			'method' => 'getEditUrl'
		], 'edit');
		$this->addAction([
			'title' => 'delete',
			'method' => 'getDeleteUrl'
		], 'delete');
		return $this;
	}

	public function getVendorData()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('page',1);
		$ppr = (int)$request->getRequest('ppr',20);

		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('vendorId') as totalCount FROM vendor;");
		$this->getPager()->execute($totalRecord, $current,$ppr);
		
		$vendorModel = Ccc::getModel('Vendor');
		$vendors = $vendorModel->fetchAll("SELECT *
										FROM vendor 
										Limit {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $vendors;
	}
}