<?php Ccc::loadClass('Block_Core_Grid'); ?>
<?php
class Block_Customer_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getEditUrl($customer)
	{
		return $this->getUrl('edit', null, ['id' => $customer->customerId]);
	}

	public function getDeleteUrl($customer)
	{
		return $this->getUrl('delete', null, ['id' => $customer->customerId]);
	}

	public function prepareCollections()
	{
		$customers = $this->getCustomerData();
        foreach ($customers as &$customer) 
        {
            $billingAddress = $customer->getBillingAddresses()->getData();
            $customer->setData($billingAddress);
        }
        $this->setCollection($customers);
        return $this;
	}
	
	public function prepareColumns()
	{
		$this->addColumn([
			'title' => 'Customer Id',
			'type' => 'int'
		],'customerId');
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
			'type' => 'varchar'
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
			'title' => 'Edit',
			'method' => 'getEditUrl'
		], 'edit');
		$this->addAction([
			'title' => 'Delete',
			'method' => 'getDeleteUrl'
		], 'delete');
		return $this;
	}	

	public function getCustomerData()
	{
		$request = Ccc::getModel('Core_Request');
		$current = $request->getRequest('page',1);
		$ppr = (int)$request->getRequest('ppr',20);

		$totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('customerId') as totalCount FROM customer;");
		$this->getPager()->execute($totalRecord, $current,$ppr);
		
		$customerModel = Ccc::getModel('Customer');
		$customers = $customerModel->fetchAll("SELECT * FROM customer 
							Limit {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
		return $customers;
	}
}