<?php

namespace HMU\Bundle\MobileBundle\Twig;

use Knp\Bundle\MenuBundle\Templating\Helper\MenuHelper;
use HMU\Bundle\MobileBundle\EventListener\MobileListener;

class AutoExtendExtension extends \Twig_Extension
{
	/**
	 * @return array
	 */
	public function getFunctions()
	{
		return array(
			'auto_extend' => new \Twig_Function_Method($this, 'autoExtend', array(
				'is_safe' => array('html'),
			)),
		);
	}
	
	/**
	 * @param string $name
	 * @return string
	 * @throws \InvalidArgumentException
	 */
	public function autoExtend($template = '::base.%s.twig')
	{
		$format = MobileListener::$globals['format'];
		return sprintf($template,$format);
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'auto_extend';
	}
}
