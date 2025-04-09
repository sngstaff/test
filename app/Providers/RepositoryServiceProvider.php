<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $classes = [];

        foreach (File::allFiles(app_path('Repositories')) as $item) {
            $fileName = $item->getFileName();

            if (str_contains($fileName, 'Interface') || str_contains($fileName, 'BaseRepository')) {
                continue;
            }

            $relativePath = str_replace(app_path() . DIRECTORY_SEPARATOR, '', $item->getPathname());
            $className = 'App\\' . str_replace([DIRECTORY_SEPARATOR, '.php'], ['\\', ''], $relativePath);

            $classes[] = str_replace('.php', '', $className);
        }

        $this->bindRepositories($classes);
    }

    protected function bindRepositories($classes)
    {
        foreach ($classes as $class) {
            $reflect  = new \ReflectionClass($class);
            $abstract = $this->extractAbstract(
                $reflect->getInterfaceNames()
            );
            $this->app->bind($abstract, $class);
        }
    }

    private function extractAbstract($interfacesArr)
    {
        return collect($interfacesArr)
            ->last(fn ($interface) => str_contains($interface, 'App\\Repositories\\Interfaces'));
    }
}
