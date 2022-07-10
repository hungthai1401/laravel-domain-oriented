<?php

namespace HT\LaravelDomainOriented\Commands;

use HT\LaravelDomainOriented\Actions\CheckExistsDomainDirectoryAction;
use HT\LaravelDomainOriented\Actions\CreateDomainDirectoryAction;
use HT\LaravelDomainOriented\Actions\CreateRootDomainDirectoryAction;
use HT\LaravelDomainOriented\Actions\GenerateDomainStructureAction;
use HT\LaravelDomainOriented\Entities\Domain;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

class MakeDomainCommand extends Command
{
    /** @var string */
    protected $signature = 'domain:make {name : The domain name}';

    /** @var string */
    protected $description = 'Create a new domain structure.';

    /** @var Filesystem|null */
    protected ?Filesystem $file;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->file = $filesystem;
    }

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
        GenerateDomainStructureAction $generateDomainStructureAction,
    ): void {
        $domainName = $this->argument('name');

        $domain = (new Domain())
            ->setName($domainName);

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

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the domain',],
        ];
    }
}
