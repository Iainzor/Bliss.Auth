<?php
namespace Acl;

class Acl extends \Bliss\Resource
{
	const RESOURCE_NAME = "acl";
	
	/**
	 * @var \Acl\Permission\Permission[]
	 */
	private $permissions = [];
	
	public function resourceName() { return self::RESOURCE_NAME; }
	
	/**
	 * Set a permission for a resource
	 * 
	 * The only required parameter is $resourceName
	 * If no $resourceId is provided, all resources will be affected
	 * If no $action is set, all actions for a resource will be affected
	 * 
	 * @param string $resourceName
	 * @param string $action
	 * @param int $resourceId
	 * @param boolean $isAllowed
	 */
	public function set($resourceName, $action = null, $resourceId = 0, $isAllowed = true)
	{
		$permission = Permission\Permission::factory([
			"resourceName" => $resourceName,
			"resourceId" => $resourceId,
			"action" => $action,
			"isAllowed" => (boolean) $isAllowed
		]);
		
		$this->permissions[$resourceName][] = $permission;
	}
	
	/**
	 * Allow a resource
	 * Short hand for set()
	 * 
	 * @param string $resourceName
	 * @param string $action
	 * @param int $resourceId
	 */
	public function allow($resourceName, $action = null, $resourceId = 0)
	{
		$this->set($resourceName, $action, $resourceId, true);
	}
	
	/**
	 * Deny access to a resource
	 * 
	 * Short hand for set()
	 * 
	 * @param string $resouceName
	 * @param string $action
	 * @param int $resourceId
	 */
	public function deny($resourceName, $action = null, $resourceId = 0)
	{
		$this->set($resourceName, $action, $resourceId, false);
	}
	
	/**
	 * Check if the ACL has access to a resource
	 * 
	 * @param string $resourceName
	 * @param string $action
	 * @param int $resourceId
	 * @return boolean
	 */
	public function isAllowed($resourceName, $action = null, $resourceId = 0)
	{
		$allowed = false;
		
		if (isset($this->permissions[$resourceName])) {
			$perms = array_filter($this->permissions[$resourceName], function(Permission\Permission $perm) use ($action) {
				return $perm->getAction() === $action || $perm->getAction() === null;
			});
			
			foreach ($perms as $perm) {
				if ($perm->getResourceId() === (int) $resourceId || !$perm->getResourceId()) {
					if ($perm->isAllowed()) {
						$allowed = true;
					} else if ($allowed && !$perm->isAllowed()) {
						$allowed = false;
					}
				}
			}
		}
		
		return $allowed;
	}
	
	/**
	 * Get all permissions in the ACL
	 * 
	 * @return \Acl\Permission\Permission[]
	 */
	public function permissions()
	{
		$permissions = [];
		foreach ($this->permissions as $resourcePerms) {
			$permissions = array_merge($permissions, $resourcePerms);
		}
		return $permissions;
	}
	
	/**
	 * Add a permission to the ACL
	 * 
	 * @param \Acl\Permission\Permission $permission
	 */
	public function add(Permission\Permission $permission)
	{
		$i = $permission->getResourceName();
		if (!isset($this->permissions[$i])) {
			$this->permissions[$i] = [];
		}
		
		$this->permissions[$i][] = $permission;
	}
	
	/**
	 * Merge another ACL with this one
	 * 
	 * @param \Acl\Acl $acl
	 */
	public function merge(Acl $acl)
	{
		foreach ($acl->permissions() as $permission) {
			$this->add($permission);
		}
	}
	
	/**
	 * Add additional properties to the exported array
	 * 
	 * @return array
	 */
	public function toArray() {
		$data = array_merge(parent::toArray(), [
			"permissions" => $this->_parse("permissions", $this->permissions())
		]);
		
		return $data;
	}
}