<?php
namespace Yurun\Until;

class Event
{
	/**
	 * 事件绑定记录
	 */
	private static $events = array();
	
	/**
	 * 注册事件
	 * @param string $event
	 * @param mixed $callback
	 * @param bool $first 是否优先执行，以靠后设置的为准
	 */
	public static function register($event, $callback, $first = false)
	{
		if (!isset(self::$events[$event]))
		{
			self::$events[$event] = array();
		}
		if($first)
		{
			array_unshift(self::$events[$event], $callback);
		}
		else 
		{
			self::$events[$event][] = $callback;
		}
	}

	/**
	 * 注册事件，register的别名
	 * @param string $event
	 * @param mixed $callback
	 * @param bool $first 是否优先执行，以靠后设置的为准
	 */
	public static function on($event, $callback, $first = false)
	{
		self::register($event, $callback, $first);
	}
	
	/**
	 * 触发事件(监听事件)
	 * 不是引用传参方式，如有需要请使用triggerReference方法
	 * @param name $event        	
	 * @param boolean $once        	
	 * @return mixed
	 */
	public static function trigger($event, $params = array())
	{
		if (isset(self::$events[$event]))
		{
			foreach (self::$events[$event] as $item)
			{
				if(true === call_user_func($item, $params))
				{
					// 事件返回true时不继续执行其余事件
					return true;
				}
			}
			return false;
		}
		return true;
	}
}