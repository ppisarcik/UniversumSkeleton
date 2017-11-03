<?php

namespace App;

use Drahak\Restful\Application\Routes\CrudRoute;
use Nette;
use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;
use Drahak\Restful\Application\Routes\ResourceRoute;


class RouterFactory
{
	use Nette\StaticClass;

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList;

        $admin = new RouteList('Admin');
        $admin[] = new Route('[<locale=en sk|cs|en>/]admin/<presenter>/<action>[/<id>]', 'Homepage:default');
        $router[] = $admin;

        $login = new RouteList('Login');
        $login[] = new Route('sign-in', 'Sign:in');
        $login[] = new Route('sign-out', 'Sign:out');
        $login[] = new Route('forgot-password', 'Sign:ForgotPassword');
        $login[] = new Route('reset-password', 'ForgotPassword:default');
        $router[] = $login;

        $front = new RouteList('Front');
        $front[] = new Route('kategoria', 'Category:default');
        $front[] = new Route('kategoria/[<id>]', 'Category:show');
        $front[] = new Route('clanok/[<id>]', 'Article:show');
        $front[] = new Route('/kontakt', 'Contact:default');
        $front[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');

        $router[] = $front;

        $router[] = new CrudRoute('api/v1/<presenter>[/<id>]', 'Base');
        $router[] = new Route('<presenter>/<action>[/<id>]', 'Front:Homepage:default');

        return $router;
	}

}
