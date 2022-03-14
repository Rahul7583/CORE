<?php 
class Model_Core_Pager
{
	protected $perPageCountOption = [10,20,30,50,100];
	public $perPageCount = null;
	public $pageCount = null;
	public $totalCount = 0;
	public $start = 1;
	public $end = null;
	public $prev = null;
	public $current = null;
	public $startLimit = null;
	public $endLimit = null;
	public $next = null;

	public function setPerPageCount($perPageCount)
	{
		$this->perPageCount = $perPageCount;
		return $this->perPageCount;
	}

	public function getPerPageCount()
	{
		return $this->perPageCount;
	}

	public function perPageCountOption($perPageCountOption)
	{
		$this->perPageCountOption = $perPageCountOption;
		return $this;	
	}

	public function getPerPageCountOption()
	{
		return $this->perPageCountOption;
	}

	public function setPageCount($pageCount)
	{
		$this->pageCount = $pageCount;
		return $this->pageCount;
	}

	public function getPageCount()
	{
		return $this->pageCount;
	}

	public function setTotalCount($totalCount)
	{
		$this->totalCount = $totalCount;
		return $this->totalCount;
	}

	public function getTotalCount()
	{
		return $this->totalCount;
	}

	public function setStart($start)
	{
		$this->start = $start;
		return $this->start;
	}

	public function getStart()
	{
		return $this->start;
	}

	public function setEnd($end)
	{
		$this->end = $end;
		return $this->end;
	}

	public function getEnd()
	{
		return $this->end;
	}

	public function setPrev($prev)
	{
		$this->prev = $prev;
		return $this->prev;
	}

	public function getPrev()
	{
		return $this->prev;
	}

	public function setCurrent($current)
	{
		$this->current = $current;
		return $this->current;
	}

	public function getCurrent()
	{
		return $this->current;
	}

	public function setStartLimit($startLimit)
	{
		$this->startLimit = $startLimit;
		return $this->startLimit;
	}

	public function getStartLimit()
	{
		return $this->startLimit;
	}

	public function setEndLimit($endLimit)
	{
		$this->endLimit = $endLimit;
		return $this->endLimit;
	}

	public function getEndLimit()
	{
		return $this->endLimit;
	}

	public function setNext($next)
	{
		$this->next = $next;
		return $this;
	}

	public function getNext()
	{
		return $this->next;
	}

	public function execute($totalCount, $current,$perPageCountOption)
	{
		$this->setPerPageCount($perPageCountOption);
        $this->setPageCount($perPageCountOption);
        $this->setEnd($perPageCountOption);
        $this->setPrev($perPageCountOption);
        $this->setNext($perPageCountOption);
        $this->setCurrent($perPageCountOption);
        $this->setStartLimit($perPageCountOption);
        $this->setEndLimit($perPageCountOption);
        foreach ($totalCount as $key => $value) {
        	$totalCount = $value;
        	$this->setTotalCount($totalCount);
        }

		$this->setPageCount(ceil($this->getTotalCount() / $this->getPerPageCount()));
		$this->setCurrent(($current > $this->getPageCount()) ? $this->getPageCount() : $current);
        $this->setCurrent(($this->getCurrent() < $this->getStart()) ? $this->getStart() : $this->getCurrent());
		$this->setStart(($this->getCurrent() == 1) ? null : 1);
        $this->setPrev(($this->getCurrent() == 1) ? null : $this->getCurrent() - 1);
        $this->setNext(($this->getCurrent() == $this->getPageCount()) ? null : $this->getCurrent() + 1);
        $this->setEnd(($this->getCurrent() == $this->getPageCount()) ? null : $this->getPageCount());
        $this->setStartLimit($this->getPerPageCount() * ($this->getCurrent() - 1));
        $this->setEndLimit($this->getCurrent() * $this->getPerPageCount());
	}

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}
}

