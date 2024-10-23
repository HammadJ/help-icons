<?php
namespace Hammadj\HelpIcons\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeViewsCommand extends Command
{
    protected $signature = 'make:help-views {--livewire}';
    protected $description = 'Generate help views with Livewire or Blade';

    public function handle()
    {
        $isLivewire = $this->option('livewire');
        $viewType = $isLivewire ? 'Livewire' : 'Blade';

        if ($this->confirm("Do you wish to generate {$viewType} views?", true)) {
            $this->generateViews($isLivewire);
            $this->generateRoutes($isLivewire);

            $this->info("{$viewType} views generated successfully.");
        }
    }

    protected function generateViews($isLivewire)
    {
        $viewsPath = resource_path('views/help');
        if (!File::exists($viewsPath)) {
            File::makeDirectory($viewsPath, 0755, true);
        }

        $viewFile = $isLivewire ? 'livewire-view.stub' : 'blade-view.stub';
        $viewContent = File::get(__DIR__ . "/stubs/{$viewFile}");

        File::put("{$viewsPath}/index.blade.php", $viewContent);
        File::put("{$viewsPath}/form.blade.php", $viewContent);

        if ($isLivewire) {
            $this->generateLivewireComponent();
        }
    }

    protected function generateRoutes($isLivewire)
    {
        $routesPath = base_path('routes/web.php');

        $routes = $isLivewire
            ? "Route::get('/help', App\\Http\\Livewire\\HelpIndex::class);"
            : "Route::get('/help', [\\YourPackageNamespace\\Http\\Controllers\\HelpController::class, 'index']);";

        File::append($routesPath, "\n" . $routes);
    }

    protected function generateLivewireComponent()
    {
        $livewirePath = app_path('Http/Livewire/HelpIndex.php');
        if (!File::exists($livewirePath)) {
            $stub = File::get(__DIR__ . '/stubs/livewire-class.stub');
            File::put($livewirePath, $stub);
        }
    }
}
