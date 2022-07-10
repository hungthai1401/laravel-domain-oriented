<?php

namespace HT\LaravelDomainOriented\Entities;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class Domain
{
    protected string $name;

    protected string $dir;

    protected string $stubDir;

    public function __construct()
    {
        $this->dir = base_path(Config::get('domain.dir'));
        $this->stubDir = __DIR__ . '/../Stubs';
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDir(): string
    {
        return $this->dir;
    }

    public function getStubDir(): string
    {
        return $this->stubDir;
    }

    public function getPath(): string
    {
        return sprintf('%s/%s', $this->dir, Str::title($this->name));
    }
}
