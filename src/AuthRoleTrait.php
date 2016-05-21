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


/**
 * AuthRoleTrait
 *
 * @category Auth
 * @package  Fusible\AuthRole
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     http://github.com/fusible/fusible.authrole
 */
trait AuthRoleTrait
{

    /**
     * Guest Role
     *
     * @var string
     *
     * @access protected
     */
    protected $guestRole = 'guest';

    /**
     * Member Role
     *
     * @var string
     *
     * @access protected
     */
    protected $memberRole = 'member';

    /**
     * Role Key
     *
     * Key in `userdata` that should be returned as the RoleID
     *
     * @var string
     *
     * @access protected
     */
    protected $roleKey = 'role';

    /**
     * Set Role Key
     *
     * @param string $key in userdata where roleId is stored
     *
     * @return $this
     *
     * @access public
     */
    public function setRoleKey($key)
    {
        $this->roleKey = $key;
        return $this;
    }

    /**
     * Set Guest Role
     *
     * @param string $role role to return when auth is not valid
     *
     * @return $this
     *
     * @access public
     */
    public function setGuestRole($role)
    {
        $this->guestRole = $role;
        return $this;
    }

    /**
     * Set Member Role
     *
     * @param string $role role to return when auth is valid w/o roleKey
     *
     * @return $this
     *
     * @access public
     */
    public function setMemberRole($role)
    {
        $this->memberRole = $role;
        return $this;
    }

    /**
     * Get Role from Auth
     *
     * @param AuraAuth $auth Auth object
     *
     * @return string
     *
     * @access protected
     */
    protected function getRoleFromAuth(AuraAuth $auth)
    {
        if (! $auth->isValid()) {
            return $this->guestRole;
        }

        $data = $auth->getUserData();

        return isset($data[$this->roleKey])
            ? $data[$this->roleKey]
            : $this->memberRole;
    }
}
