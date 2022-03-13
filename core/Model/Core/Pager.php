<?php 
class Model_Core_Pager
{
	public $perPageCount = 20;
	public $pageCount;
	public $totalCount;
	public $start = 1;
	public $end;
	public $prev;
	public $current;
	public $startLimit;
	public $endLimit;
	public $next;

	public function setPerPageCount($perPageCount)
	{
		$this->perPageCount = $perPageCount;
		return $this->perPageCount;
	}

	public function getPerPageCount()
	{
		return $this->perPageCount;
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

	public function excute($totalCount, $current)
	{

		$this->setTotalCount($totalCount);
		$this->setPageCount(ceil($this->getTotalCount() / $this->getPerPageCount()));
		$this->setCurrent(($current > $this->getPageCount()) ? $this->getPageCount() : $current);
        $this->setCurrent(($this->getCurrent() < $this->getStart()) ? $this->getStart() : $this->getCurrent());
		$this->setStart(($this->getCurrent() == 1) ? null : 1);
        $this->setPrev(($this->getCurrent() == 1) ? null : $this->getCurrent() - 1);
        $this->setNext(($this->getCurrent() == $this->getPageCount()) ? null : $this->getCurrent() + 1);
        $this->setEnd(($this->getCurrent() == $this->getPageCount()) ? null : $this->getPageCount());
        $this->setStartLimit($this->getPerPageCount() * ($this->getCurrent() - 1));
        $this->setEndLimit($this->getCurrent() * $this->getPerPageCount());
		/*$this->setTotalCount($totalCount);
		$this->setStart($this->getCurrent() == 1) ? Null : 1;

		$this->setPageCount(ceil($this->getTotalCount() / $this->getPerPageCount()));
		$this->setEnd($this->getCurrent() == $this->getPageCount()) ? Null : $this->getPageCount();

		$this->setCurrent(($current > $this->getPageCount()) ? $this->getPageCount() : $current);
		$this->setCurrent(($current < $this->getStart()) ? $this->getStart() : $current);

		$this->setPrev(($this->getCurrent() == $this->getStart()) ? Null : $this->getCurrent() - 1);
		$this->setNext(($this->getCurrent() == $this->getEnd()) ? Null : $this->getCurrent() + 1);
		$this->setStartLimit($this->getPerPageCount() * ($this->getCurrent() - 1) + 1);
		$this->setEndLimit($this->getPerPageCount() * $this->getCurrent());*/
	}

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}
}

