<?php

namespace HT\LaravelDomainOriented\Actions;

use HT\LaravelDomainOriented\Entities\Domain;
use Illuminate\Filesystem\Filesystem;

class GenerateDomainStructureAction
{
    /**
     * @param Domain $domain
     * @param Filesystem $file
     * @return bool
     */
    public function execute(Domain $domain, Filesystem $file): bool
    {
        return $file->copyDirectory($domain->getStubDir(), $domain->getPath());
    }
}
