<?php

namespace App\Providers;

use App\Repositories\Eloquent\NotebookRepository;
use App\Repositories\Eloquent\NotesRepository;
use App\Repositories\NotebookRepositoryInterface;
use App\Repositories\NotesRepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NotebookRepositoryInterface::class, NotebookRepository::class);
        $this->app->bind(NotesRepositoryInterface::class, NotesRepository::class);
        $this->app->bind(UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
