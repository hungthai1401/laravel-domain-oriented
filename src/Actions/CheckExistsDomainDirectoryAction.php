<?php

namespace HT\LaravelDomainOriented\Actions;

use HT\LaravelDomainOriented\Entities\Domain;
use Illuminate\Filesystem\Filesystem;

class CheckExistsDomainDirectoryAction
{
    /**
     * @param Domain $domain
     * @param Filesystem $file
     * @return bool
     */
    public function execute(Domain $domain, Filesystem $file): bool
    {
        return $file->exists($domain->getPath());
    }
}
