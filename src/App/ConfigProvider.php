<?php

declare(strict_types=1);

namespace App;

use App\Handler\MetricsHandler;
use App\Handler\QuoteHandler;
use App\Handler\QuoteHandlerFactory;
use App\Service\Factory\ServiceFactory;
use App\Service\QuoteService;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
                Handler\QuoteHandler::class => Handler\QuoteHandler::class,
                Handler\MetricsHandler::class => Handler\MetricsHandler::class
            ],
            'factories'  => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
                Handler\QuoteHandler::class => Handler\QuoteHandlerFactory::class,
                Handler\MetricsHandler::class => Handler\MetricsHandlerFactory::class,
                Service\QuoteService::class => Service\Factory\ServiceFactory::class
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => ['templates/app'],
                'error'  => ['templates/error'],
                'layout' => ['templates/layout'],
            ],
        ];
    }
}
