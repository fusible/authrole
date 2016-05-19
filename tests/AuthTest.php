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
            [ Status::ANON, Auth::GUEST ],
            [ Status::EXPIRED, Auth::GUEST ],
            [ Status::IDLE, Auth::GUEST],
            [ Status::VALID, Auth::MEMBER ],
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
        $this->assertEquals(Auth::GUEST, $this->auth->getRoleId());
    }

}
