<?php

namespace FmTod\Quotes;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;

class QuotesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('quotes')
            ->hasConfigFile()
            ->hasMigrations([
                'create_quotes_table',
                'create_roles_table',
                'quote_user_table',
                'role_user_table',
            ])
            ->publishesServiceProvider('QuotesServiceProvider')
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    // ->publishAssets()
                    ->publishMigrations()
                    // ->askToRunMigrations()
                    ->copyAndRegisterServiceProviderInApp()
                    // ->askToStarRepoOnGitHub('your-vendor/your-repo-name')
                ;
            });

        
    }
}
