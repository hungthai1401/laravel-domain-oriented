<?php

namespace HT\LaravelDomainOriented\Commands;

use HT\LaravelDomainOriented\Entities\Domain;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

abstract class AbstractDomainCommand extends Command
{
    /** @var Filesystem|null */
    protected $file;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->file = $filesystem;
    }

    /**
     * @return Domain
     */
    public function getDomain(): Domain
    {
        return (new Domain())
            ->setName($this->argument('name'));
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
