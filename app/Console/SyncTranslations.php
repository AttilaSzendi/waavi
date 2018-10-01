<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SyncTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translator:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $langDirectory = base_path() . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'lang';
        $locales = File::directories($langDirectory);
        $languageFiles = File::files($langDirectory . DIRECTORY_SEPARATOR . 'en');
        foreach ($languageFiles as $languageFile) {
            $emptyTranslations = [];
            foreach (File::getRequire($languageFile) as $key => $value) {
                $emptyTranslations[$key] = '';
            }
            $stub = file_get_contents(__DIR__ . '/stubs/language.stub');
            $stub = str_replace('$LanguageData', var_export($emptyTranslations, true), $stub);
            foreach ($locales as $locale) {
                if (basename($locale) != 'en' && basename($locale) != 'vendor') {
                    File::put($locale . DIRECTORY_SEPARATOR . basename($languageFile), $stub);
                }
            }
        }
        Artisan::call('translator:load');
        Artisan::call('cache:clear');
    }
}
