<?php
namespace Acl\Tests;

use Acl\Role\Role;

class RoleTest extends \PHPUnit_Framework_TestCase
{
	public function testRole()
	{
		$role = new Role("my-role");
		
		$this->assertFalse($role->isAllowed("my-resource", "read"));
		$this->assertEquals("my-role", $role->getName());
	}
	
	public function testRolePermissions()
	{
		$user = new Role("user");
		$admin = new Role("admin");
		
		$user->allow("my-resource", "read");
		$admin->allow("my-resource");
		
		$this->assertFalse($user->isAllowed("my-resource", "delete"));
		$this->assertTrue($admin->isAllowed("my-resource", "delete"));
	}
}