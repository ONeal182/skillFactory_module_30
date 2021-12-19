<?php
class View
{
	public $test;
	function generate($content_view, $template_view, $data = null)
	{
		include 'application/views/' . $template_view;
		

	}
}
