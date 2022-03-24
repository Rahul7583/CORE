<?php Ccc::loadClass('Model_Core_Row'); ?>
<?php
class Model_Category_Media extends Model_Core_Row
{

	protected $mediaPath = "Media/Category";

	public function __construct()
	{
		$this->setResourceClassName('Category_Media_Resource');
			
	}

	public function getImageUrl()
	{
		return Ccc::getBaseUrl($this->mediaPath.'/'.$this->name);
	}
}

