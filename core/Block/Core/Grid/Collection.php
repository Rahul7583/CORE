<?php Ccc::loadClass('Block_Core_Template');

class Block_Core_Grid_Collection extends Block_Core_Template   
{
    protected $actions = [];
    protected $collections = [];
    protected $grid = null;
    protected $currentCollection = null;

    public function __construct()
    {
        $this->prepareCollections();
    }

    public function prepareCollections()
    {
        return $this;
    }

    public function setActions(array $actions)
    {
        $this->actions = $actions;
        return $this;
    }
    
    public function getActions()
    {
        if(!$this->actions)
        {
            $actions = [
                'edit'=>['title'=> 'edit','method'=>'$this->getEditUrl()'],
                'delete'=>['title'=> 'delete','method'=>'$this->getDeleteUrl()']
                    ];
            $this->setActions($actions);
        }
        return $this->actions;
    }

    
