<?php Ccc::loadClass('Block_Core_Grid_Collection');

class Block_Admin_Grid_Collection extends Block_Core_Grid_Collection
{
    public function __construct()
    {
        parent::__construct();
        $this->setCurrentCollection('personal');
    }

    public function prepareCollections()
    {
        $this->addCollection([
            'header' => ['AdminId','First Name','Last Name','Email','Status','Created Date','Updated Date'],
            'action' => $this->getActions(),
            'url' => $this->getUrl(null,null,['Collection' => 'personal'])
        ],'personal');
        $this->prepareCollectionContent();       
    }

    public function getAdminData()
    {
        $request = Ccc::getModel('Core_Request');
        $current = $request->getRequest('page',1);
        $ppr = (int)$request->getRequest('ppr',20);

        $totalRecord = $this->getPager()->getAdapter()->fetchOne("SELECT count('adminId') as totalCount FROM admin;");
        $this->getPager()->execute($totalRecord, $current,$ppr);
        $adminModel = Ccc::getModel('Admin'); 
        $admin = $adminModel->fetchAll("SELECT * FROM admin Limit {$this->getPager()->getStartLimit()}, {$this->getPager()->getEndLimit()}");
        return $admin;
    }

    public function prepareCollectionContent()
    {
        $admins = $this->getAdminData();
        $array=[];
        foreach($admins as $admin)
        {
            $admin->status = $admin->getStatus($admin->status);
            $array1=[];   
            foreach($admin->getData() as $key => $value)
            {
                $array1[]=$value;
            }
            array_push($array,$array1);
            
        }
        $this->setColumns($array);
        return $this;
    }