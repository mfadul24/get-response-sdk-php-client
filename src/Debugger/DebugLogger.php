<?php
namespace Getresponse\Sdk\Client\Debugger;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Psr\Log\LogLevel;

/**
 * Class DebugLogger
 * @package Getresponse\Sdk\Client\Debugger
 */
class DebugLogger implements LoggerInterface
{
    use LoggerTrait;
    
    /**
     * DebugLogger constructor.
     * @param DataCollector $dataCollector
     */
    public function __construct(private readonly DataCollector $dataCollector)
    {
    }
    
    /**
     * @inheritDoc
     */
    public function log($level, $message, array $context = []): void
    {
        if (LogLevel::DEBUG) {
            if (isset($context['request']) && !isset($context['response'])) {
                $this->dataCollector->collectRequest($context['request']);
            }
            if (isset($context['response'])) {
                $request = $context['request'] ?? null;
                $info = $context['info'] ?? null;
                $this->dataCollector->collectResponse($context['response'], $request, $info);
            }
        }
    }
    
}
