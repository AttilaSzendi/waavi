<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {moduleName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a module with default setup';

    protected $moduleDirectoryPath;
    protected $concreteModulePath;
    protected $moduleName;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->saveDirectoryPaths();
        $this->createModuleDirectoryIfNotExists();

        if(!$this->createDirectoryWithRequestedName()){
            $this->alert("The $this->moduleName module is already exists");
            return;
        }

        $this->createSrcDirectory();
        $this->createDatabaseDirectory();
        $this->createMigrationsDirectory();
        $this->createHttpDirectory();
        $this->createControllersDirectory();
        $this->createRequestsDirectory();
        $this->createHandlersDirectory();
        $this->createContractsDirectory();
        $this->createRepositoriesDirectory();
        $this->createRepositoriesDirectoryInContracts();
        $this->createHandlersDirectoryInContracts();

        $this->info('fasza');
    }

    private function createModuleDirectoryIfNotExists(): void
    {
        if (!File::exists($this->moduleDirectoryPath)) {
            File::makeDirectory($this->moduleDirectoryPath);
        }
    }

    private function createDirectoryWithRequestedName()
    {
        if (File::exists($this->concreteModulePath)) {
            return false;
        };

        return File::makeDirectory($this->concreteModulePath);
    }

    private function createSrcDirectory()
    {
        $path = $this->srcDirectoryPath();

        return File::makeDirectory($path);
    }

    private function createDatabaseDirectory()
    {
        $path = $this->concreteModulePath;
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'database';

        return File::makeDirectory($path);
    }

    private function createMigrationsDirectory()
    {
        $path = $this->concreteModulePath;
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'database';
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'migrations';

        return File::makeDirectory($path);
    }

    private function createHttpDirectory()
    {
        $path = $this->srcDirectoryPath();
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'Http';

        return File::makeDirectory($path);
    }

    private function createControllersDirectory()
    {
        $path = $this->srcDirectoryPath();
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'Http';
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'Controllers';

        return File::makeDirectory($path);
    }

    private function createRequestsDirectory()
    {
        $path = $this->srcDirectoryPath();
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'Http';
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'Requests';

        return File::makeDirectory($path);
    }

    private function createHandlersDirectory()
    {
        $path = $this->srcDirectoryPath();
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'Handlers';

        return File::makeDirectory($path);
    }

    private function createContractsDirectory()
    {
        $path = $this->srcDirectoryPath();
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'Contracts';

        return File::makeDirectory($path);
    }

    private function createRepositoriesDirectory()
    {
        $path = $this->srcDirectoryPath();
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'Repositories';

        return File::makeDirectory($path);
    }

    private function createRepositoriesDirectoryInContracts()
    {
        $path = $this->srcDirectoryPath();
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'Contracts';
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'Repositories';

        return File::makeDirectory($path);
    }

    private function createHandlersDirectoryInContracts()
    {
        $path = $this->srcDirectoryPath();
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'Contracts';
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'Handlers';

        return File::makeDirectory($path);
    }

    private function saveDirectoryPaths()
    {
        $this->moduleDirectoryPath = base_path() . DIRECTORY_SEPARATOR . 'modules';
        $this->concreteModulePath =
            $this->moduleDirectoryPath . DIRECTORY_SEPARATOR . $this->argument('moduleName');
        $this->moduleName = $this->argument('moduleName');
    }

    /**
     * @return string
     */
    private function srcDirectoryPath(): string
    {
        $path = $this->concreteModulePath;
        $path .= DIRECTORY_SEPARATOR;
        $path .= 'src';
        return $path;
    }
}
