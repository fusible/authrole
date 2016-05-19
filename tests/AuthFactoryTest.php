<?php
// @codingStandardsIgnoreFile

namespace Fusible\AuthRole;

class AuthFactoryTest extends \PHPUnit_Framework_TestCase
{
    protected $factory;

    protected function setUp()
    {
        $this->factory = new AuthFactory($_COOKIE);
    }

    public function testNewAuth()
    {
        $auth = $this->factory->newInstance(array());
        $this->assertInstanceOf('Fusible\AuthRole\Auth', $auth);
        $this->assertInstanceOf('Aura\Auth\Auth', $auth);
        $this->assertInstanceOf('Zend\Permissions\Acl\Role\RoleInterface', $auth);
    }
}
