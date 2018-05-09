<?php

namespace Astrio\ObserverModule\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface as Logger;

/**
 * Class ControllerActionPredispatchObserver
 * @package Astrio\ObserverModule\Observer
 */
class ControllerActionPredispatchObserver implements ObserverInterface
{
    /** @var Logger */
    protected $logger;

    /**
     * ControllerActionPredispatchObserver constructor
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Framework\App\Request\Http $request */
        $request = $observer->getData('request');
        $pathInfo = $request->getPathInfo();

        $this->logger->info("Path info: '{$pathInfo}'");
    }
}
