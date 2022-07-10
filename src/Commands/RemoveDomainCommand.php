<?php

namespace HT\LaravelDomainOriented\Commands;

use HT\LaravelDomainOriented\Actions\CheckExistsDomainDirectoryAction;
use HT\LaravelDomainOriented\Actions\DeleteDomainDirectoryAction;

class RemoveDomainCommand extends AbstractDomainCommand
{
    /** @var string */
    protected $signature = 'domain:remove {name : The domain name}';

    /** @var string */
    protected $description = 'Remove domain structure.';

    public function handle(
        CheckExistsDomainDirectoryAction $checkExistsDomainDirectoryAction,
        DeleteDomainDirectoryAction $deleteDomainDirectoryAction
    ): void {
        if (! $this->confirm('Do you certainly want to remove this domain?', true)) {
            exit();
        }

        $domain = $this->getDomain();

        $this->info("Removing {$domain->getName()} domain");

        if (! $checkExistsDomainDirectoryAction->execute($domain, $this->file)) {
            $this->error('The domain path does not exists');
            exit();
        }

        if (! $deleteDomainDirectoryAction->execute($domain, $this->file)) {
            $this->error('The domain path have been not remove');
            exit();
        }

        $this->info("Removed {$domain->getName()} domain");
    }
}
