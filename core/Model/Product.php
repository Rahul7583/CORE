<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Product extends Model_Core_Row
{
	protected $category = null;
	protected $media = null;
	protected $gallery = null;
	protected $thumbnail = null;
	protected $base = null;
	protected $small = null;

	public function __construct()
	{
		$this->setResourceClassName('Product_Resource');		
	}

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 2;
	const STATUS_DISABLED_DEFAULT = 1;
	const STATUS_ENABLED_LBL = 'Enabled';
	const STATUS_DISABLED_LBL = 'Disabled';
	
	public function setMedia(Model_Product_Media $media)
	{
		$this->media =$media;
		return $this;
	}

	public function getMedia($reload = false)
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->media)
		{
			return null;
		}
		if($this->media && !$reload)
		{
			return $this->media;
		}
		$media = $mediaModel->fetchRow("SELECT * FROM `image` WHERE `productId` = {$this->productId}");
		if(!$media)
		{
			return null;
		}
		$this->setMedia($media);

		return $this->media;
	}

	public function setGallery(Model_Product_Media $gallery)		
	{
		$this->gallery = $gallery;
		return $this;
	}

	public function getGallery($reload = false)
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->gallery)
		{
			return $mediaModel;
		}
		if($this->gallery && !$reload)
		{
			return $this->gallery;
		}
		$gallery = $mediaModel->fetchRow("SELECT * FROM `image` WHERE `productId` = {$this->productId} AND `gallery` = 1");
		if(!$gallery)
		{
			return $mediaModel;
		}
		$this->setGallery($gallery);

		return $this->gallery;
	}

	public function setBase(Model_Product_Media $base)		
	{
		$this->base = $base;
		return $this;
	}

	public function getBase($reload = false)
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->productId)
		{
			return $mediaModel;
		}
		if($this->base && !$reload)
		{
			return $this->base;
		}
		$base = $mediaModel->fetchRow("SELECT * FROM `image` WHERE `productId` = {$this->productId} AND `base` = 1");
		if(!$base)
		{
			return $mediaModel;
		}
		$this->setBase($base);

		return $this->base;
	}

	public function setSmall(Model_Product_Media $small)		
	{
		$this->small = $small;
		return $this;
	}

	public function getSmall($reload = false)
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->productId)
		{
			return $mediaModel;
		}
		if($this->small && !$reload)
		{
			return $this->small;
		}
		$small = $mediaModel->fetchRow("SELECT * FROM `image` WHERE `productId` = {$this->productId} AND `small` = 1");
		if(!$small)
		{
			return $mediaModel;
		}
		$this->setSmall($small);

		return $this->small;
	}

	public function setThumbnail(Model_Product_Media $thumbnail)		
	{
		$this->thumbnail = $thumbnail;
		return $this;
	}

	public function getThumbnail()
	{
		$mediaModel = Ccc::getModel('Product_Media'); 
		if(!$this->productId)
		{
			return $mediaModel;
		}
		if($this->thumbnail && !$reload)
		{
			return $this->thumbnail;
		}
		$thumbnail = $mediaModel->fetchRow("SELECT * FROM `image` WHERE `productId` = {$this->productId} AND `thumbnail` = 1");
		if(!$thumbnail)
		{
			return $mediaModel;
		}
		$this->setThumbnail($thumbnail);
		return $this->thumbnail;
	}

	public function setCategories(Model_Category $category)
	{
		$this->category = $category;
		return $this;
	}

	public function getCategories($reload = false)
	{
		$categoryModel = Ccc::getModel('Category');
		if (!$this->categoryId) 
		{
			return $categoryModel;
		}
		if ($this->category && !$reload) 
		{
			return $this->category;
		}
		$category = $categoryModel->fetchRow("SELECT * FROM `categories` 
											WHERE `categoryId` = {$this->categoryId}");
		if (!$category) 
		{
			return $categoryModel;
		}
		$this->setCategories($category);
		return $category;
	}


	public function getStatus($key = null)
	{
		$status = [
			self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
			self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
		];

		if(!$key)
		{
			return $status;
		}
		if(array_key_exists($key, $status))
		{
			return $status[$key];
		}
		return self::STATUS_DISABLED_DEFAULT;
	}
}





