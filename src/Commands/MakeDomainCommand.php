<?php

namespace HT\LaravelDomainOriented\Commands;

use HT\LaravelDomainOriented\Actions\CheckExistsDomainDirectoryAction;
use HT\LaravelDomainOriented\Actions\CreateDomainDirectoryAction;
use HT\LaravelDomainOriented\Actions\CreateRootDomainDirectoryAction;
use HT\LaravelDomainOriented\Actions\GenerateDomainStructureAction;

class MakeDomainCommand extends AbstractDomainCommand
{
    /** @var string */
    protected $signature = 'domain:make {name : The domain name}';

    /** @var string */
    protected $description = 'Create a new domain structure.';

    /**
     * @param CreateRootDomainDirectoryAction $createRootDomainDirectoryAction
     * @param CheckExistsDomainDirectoryAction $checkExistsDomainDirectoryAction
     * @param CreateDomainDirectoryAction $createDomainDirectoryAction
     * @param GenerateDomainStructureAction $generateDomainStructureAction
     * @return void
     */
    public function handle(
        CreateRootDomainDirectoryAction $createRootDomainDirectoryAction,
        CheckExistsDomainDirectoryAction $checkExistsDomainDirectoryAction,
        CreateDomainDirectoryAction $createDomainDirectoryAction,
        GenerateDomainStructureAction $generateDomainStructureAction
    ): void {
        $domain = $this->getDomain();

        $this->info("Creating {$domain->getName()} domain");

        $createRootDomainDirectoryAction->execute($domain, $this->file);

        if ($checkExistsDomainDirectoryAction->execute($domain, $this->file)) {
            $this->error('The domain path already exists');
            exit();
        }

        if (! $createDomainDirectoryAction->execute($domain, $this->file)) {
            $this->error('The domain path can not be created');
            exit();
        }

        if (! $generateDomainStructureAction->execute($domain, $this->file)) {
            $this->error('The stubs can not be copied to domain path');
            exit();
        }

        $this->info("Created {$domain->getName()} domain");
    }
}
