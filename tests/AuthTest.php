<?php
// @codingStandardsIgnoreFile

namespace Fusible\AuthRole;

use Aura\Auth\Session\FakeSegment;
use Aura\Auth\Status;

class AuthTest extends \PHPUnit_Framework_TestCase
{

    protected $auth;
    protected $segment;

    protected function setUp()
    {
        $this->segment = new FakeSegment;
        $this->auth = new Auth($this->segment);
    }

    public function statusRoleProvider()
    {
        return [
            [ Status::ANON, 'guest' ],
            [ Status::EXPIRED, 'guest' ],
            [ Status::IDLE, 'guest'],
            [ Status::VALID, 'member' ],
        ];
    }

    /**
     * @dataProvider statusRoleProvider
     */
    public function testStatusRole($status, $role)
    {
        $this->auth->setStatus($status);
        $this->assertEquals($role, $this->auth->getRoleId());
    }

    public function testCustomRole()
    {
        $this->auth->setStatus(Status::VALID);
        $this->auth->setUserData(['role' => 'foo']);
        $this->assertEquals('foo', $this->auth->getRoleId());
    }

    public function testInvalidWithData()
    {
        $this->auth->setStatus(Status::ANON);
        $this->auth->setUserData(['role' => 'foo']);
        $this->assertEquals('guest', $this->auth->getRoleId());
    }

    public function testGestRole()
    {
        $this->auth->setStatus(Status::ANON);
        $this->auth->setGuestRole('foo');
        $this->assertEquals('foo', $this->auth->getRoleId());
    }

    public function testMemberRole()
    {
        $this->auth->setStatus(Status::VALID);
        $this->auth->setMemberRole('foo');
        $this->assertEquals('foo', $this->auth->getRoleId());
    }

    public function testRoleKey()
    {
        $this->auth->setStatus(Status::VALID);
        $this->auth->setUserData(['foo' => 'bar']);
        $this->auth->setRoleKey('foo');
        $this->assertEquals('bar', $this->auth->getRoleId());
    }
}
