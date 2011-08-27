<?php

namespace HMU\Bundle\MobileBundle\EventListener;

use Symfony\Component\EventDispatcher\Event;

class MobileListener
{
	protected $twig;
	protected $request;
	public static $globals;
	
	public function __construct(\Twig_Environment $twig)
	{
		$this->twig = $twig;
	}
	
	public function listener(Event $event)
	{
		$this->request = $event->getRequest();
		
		if($isMobile = $this->isMobile())
			$event->getRequest()->setRequestFormat('mobile');
		
		self::$globals = array(
			'format'   => $event->getRequest()->getRequestFormat(),
			'isMobile' => $isMobile?true:false,
		);
		$this->twig->addGlobal('hmu', self::$globals);
	}
	
	public function isMobile()
	{
		$format = $this->request->getSession()->get('format');
		
		if($format == 'mobile' or preg_match('#(Android|iPad|iPod|iPhone|Mobile|BlackBerry|Mini|Palm)#i', $this->request->headers->get('user-agent')))
			return true;
	}
}
