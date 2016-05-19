<?php
// @codingStandardsIgnoreFile

namespace Fusible\AuthRole;

use Aura\Auth\Session\FakeSegment;
use Aura\Auth\Status;
use Aura\Auth\Auth as AuraAuth;

class AuthDecoratorTest extends AuthTest
{

    protected $auth;
    protected $auraAuth;
    protected $segment;

    protected function setUp()
    {
        $this->segment = new FakeSegment;
        $this->auraAuth = new AuraAuth($this->segment);
        $this->auth = new AuthDecorator($this->auraAuth);
    }

    public function testGetAuth()
    {
        $this->assertSame($this->auraAuth, $this->auth->getAuth());
    }

}
