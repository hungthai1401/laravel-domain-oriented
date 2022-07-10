<?php

namespace HT\LaravelDomainOriented\Actions;

use HT\LaravelDomainOriented\Entities\Domain;
use Illuminate\Filesystem\Filesystem;

class CreateDomainDirectoryAction
{
    /**
     * @param Domain $domain
     * @param Filesystem $file
     * @return bool
     */
    public function execute(Domain $domain, Filesystem $file): bool
    {
        if ($file->exists($domain->getPath())) {
            return false;
        }

        return $file->makeDirectory($domain->getPath());
    }
}
