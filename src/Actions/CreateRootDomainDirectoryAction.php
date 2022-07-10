<?php

namespace HT\LaravelDomainOriented\Actions;

use HT\LaravelDomainOriented\Entities\Domain;
use Illuminate\Filesystem\Filesystem;

class CreateRootDomainDirectoryAction
{
    /**
     * @param Domain $domain
     * @param Filesystem $file
     * @return void
     */
    public function execute(Domain $domain, Filesystem $file): void
    {
        if ($file->exists($domain->getDir())) {
            return;
        }

        $file->makeDirectory($domain->getDir());
    }
}
