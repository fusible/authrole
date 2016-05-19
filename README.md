# fusible.authrole
Integrate [Aura\Auth] and [Zend\Permissions\Acl]

[![Latest version][ico-version]][link-packagist]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]

## Installation
```
composer require fusible/authrole
```

## Usage
Replace `Aura\Auth\AuthFactory` with `Fusible\AuthRole\AuthFactory`.
The resulting `Auth` object will implement
`Zend\Permissions\Acl\Role\RoleInterface`

If `$auth->isValid()` is `false`, `$auth->getRoleId()` will return `Auth::GUEST`
("guest").

If `$auth->isValid()` is `true`, `getRoleId` will look for a key `role` in the
result of `$auth->getUserData` and return that, or return `Auth::MEMBER`
("member") if it is not set.

```php
use Fusible\AuthRole\AuthFactory;
use Fusible\AuthRole\Auth;
use Zend\Permissions\Acl\Acl;

$factory = new AuthFactory($_COOKIE);
$auth = $factory->newInstance();
$acl = new Acl();

$acl->addRole(Auth::GUEST)
    ->addRole(Auth::MEMBER);

$acl->addResource('someResource');

$acl->deny('guest', 'someResource');
$acl->allow('member', 'someResource');


$resume = $factory->newResumeService();
$resume->resume($auth);

echo $acl->isAllowed($auth, 'someResource') ? 'allowed' : 'denied';

```



[Aura\Auth]: https://github.com/auraphp/Aura.Auth
[Zend\Permissions\Acl]: https://github.com/zendframework/zend-permissions-acl

[ico-version]: https://img.shields.io/packagist/v/fusible/authrole.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/fusible/fusible.authrole/develop.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/fusible/fusible.authrole.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/fusible/fusible.authrole.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/fusible/authrole
[link-travis]: https://travis-ci.org/fusible/fusible.authrole
[link-scrutinizer]: https://scrutinizer-ci.com/g/fusible/fusible.authrole
[link-code-quality]: https://scrutinizer-ci.com/g/fusible/fusible.authrole
