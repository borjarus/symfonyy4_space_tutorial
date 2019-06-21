<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use App\Service\MarkdownHelper;
use Symfony\Component\DependencyInjection\ServiceSubscriberInterface;
use Psr\Container\ContainerInterface;

class AppExtension extends AbstractExtension implements ServiceSubscriberInterface
{
    private $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('cached_markdown', [$this, 'processMarkdown'], ['is_safe' => ['html']]),
        ];
    }


    public function processMarkdown($value)
    {
        return $this->container->get(MarkdownHelper::class)->parse($value);
    }

    public static function getSubscribedServices()
    {
        return [
            MarkdownHelper::class,
        ];
    }
}
