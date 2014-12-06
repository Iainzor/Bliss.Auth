<?php
namespace Acl\Permission;

class Permission extends \Bliss\Resource
{
	const RESOURCE_NAME = "acl-permission";
	
	/**
	 * @var boolean
	 */
	protected $isAllowed = false;
	
	public function resourceName() { return self::RESOURCE_NAME; }
	
	/**
	 * Set whether this permission is allowed
	 * 
	 * @param boolean $isAllowed
	 */
	public function setIsAllowed($isAllowed)
	{
		$this->isAllowed = (boolean) $isAllowed;
	}
	
	/**
	 * Check if the permission is allowed
	 * 
	 * @return boolean
	 */
	public function isAllowed()
	{
		return $this->isAllowed;
	}
	
	/**
	 * Generate a unqiue hash for a permission
	 * 
	 * @param string $resourceName
	 * @param int $resourceId
	 * @param string $action
	 * @return string
	 */
	public static function generateHash($resourceName, $resourceId = 0, $action = null)
	{
		return implode(".", [
			$resourceName,
			$resourceId ? (int) $resourceId : "*",
			$action ? $action : "*"
		]);
	}
}