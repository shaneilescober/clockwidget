<?php
class common
{
	function modelContents()
	{
		return getInstance('modelWorldClock');
	}
	
	function getFullUrl() {
		return $_SERVER['REQUEST_URI'];
	}
}