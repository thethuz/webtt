<?php


namespace Acme\Facade;

Class Foo extends \Illuminate\Support\Facades\Facade
{
	public static function getFacadeAccessor()
	{
		return 'foo';
	}
}