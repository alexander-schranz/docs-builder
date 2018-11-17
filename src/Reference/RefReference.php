<?php

namespace SymfonyDocs\Reference;

use Doctrine\RST\Environment;
use Doctrine\RST\References\Reference;
use Doctrine\RST\References\Resolver;
use Doctrine\RST\References\ResolvedReference;

class RefReference extends Reference
{
    public function getName(): string
    {
        return 'ref';
    }

    public function resolve(Environment $environment, string $data): ResolvedReference
    {
        $resolver = new Resolver();
        $resolvedReference = $resolver->resolve($environment, $data, ['class' => 'reference internal', 'domElement' => 'span']);
        if (!$resolvedReference) {
            throw  new \RuntimeException(sprintf('Reference "%s" could not be resolved', $data));
        }

        return $resolvedReference;
    }

    public function found(Environment $environment, string $data) : void
    {
        $environment->addDependency($data);
    }
}
