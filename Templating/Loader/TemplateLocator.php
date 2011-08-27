<?php

namespace HMU\Bundle\MobileBundle\Templating\Loader;

use Symfony\Bundle\FrameworkBundle\Templating\Loader\TemplateLocator as BaseTemplateLocator;

class TemplateLocator extends BaseTemplateLocator
{
	/**
	 * Returns a full path for a given file.
	 *
	 * @param TemplateReferenceInterface $template     A template
	 * @param string                     $currentPath  Unused
	 * @param Boolean                    $first        Unused
	 *
	 * @return string The full path for the file
	 *
	 * @throws \InvalidArgumentException When the template is not an instance of TemplateReferenceInterface
	 * @throws \InvalidArgumentException When the template file can not be found
	 */
	public function locate($template, $currentPath = null, $first = true)
	{
		try {
			return parent::locate($template, $currentPath, $first);
		} catch (\InvalidArgumentException $e) {
			if($template->get('format') == 'mobile')
			{
				$template->set('format','html');
				return parent::locate($template, $currentPath, $first);
			}
		}
	}
}
