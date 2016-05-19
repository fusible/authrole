<?php
/**
 * Fusible AuthRole - Aura\Auth + Zend\Acl integration
 *
 * PHP version 5
 *
 * Copyright (C) 2016 Jake Johns
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 *
 * @category  Auth
 * @package   Fusible\AuthRole
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2016 Jake Johns
 * @license   http://jnj.mit-license.org/2016 MIT License
 * @link      http://github.com/fusible/fusible.authrole
 */

namespace Fusible\AuthRole;

use Aura\Auth\Auth as AuraAuth;
use Zend\Permissions\Acl\Role\RoleInterface;

/**
 * Auth
 *
 * @category Auth
 * @package  Fusible\AuthRole
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/fusible/fusible.authrole
 *
 * @see RoleInterface
 * @see AuraAuth
 */
class AuthDecorator implements RoleInterface
{
    use AuthRoleTrait;

    /**
     * Auth
     *
     * @var mixed
     *
     * @access protected
     */
    protected $auth;

    /**
     * __construct
     *
     * @param AuraAuth $auth DESCRIPTION
     *
     * @return mixed
     *
     * @access public
     */
    public function __construct(AuraAuth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Get Role Id
     *
     * @return string
     *
     * @access public
     */
    public function getRoleId()
    {
        return $this->getRoleFromAuth($this->auth);
    }

    /**
     * GetAuth
     *
     * @return mixed
     *
     * @access public
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * __call
     *
     * @param mixed $method DESCRIPTION
     * @param mixed $params DESCRIPTION
     *
     * @return mixed
     *
     * @access public
     */
    public function __call($method, $params)
    {
        return call_user_func_array([$this->auth, $method], $params);
    }
}
