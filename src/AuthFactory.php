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
 * @category  Factory
 * @package   Fusible\AuthRole
 * @author    Jake Johns <jake@jakejohns.net>
 * @copyright 2016 Jake Johns
 * @license   http://jnj.mit-license.org/2016 MIT License
 * @link      https://github.com/fusible/fusible.authrole
 */

namespace Fusible\AuthRole;

use Aura\Auth\AuthFactory as AuraAuthFactory;

/**
 * Auth Factory
 *
 * @category Factory
 * @package  Fusible\AuthRole
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://jnj.mit-license.org/ MIT License
 * @link     https://github.com/fusible/fusible.authrole
 *
 * @see AuraAuthFactory
 */
class AuthFactory extends AuraAuthFactory
{
    /**
     * Returns a new authentication tracker with ACL support
     *
     * @return Auth
     *
     * @access public
     */
    public function newInstance()
    {
        return new Auth($this->segment);
    }
}
