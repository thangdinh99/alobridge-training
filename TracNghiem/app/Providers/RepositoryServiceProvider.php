<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{

			app()->singleton(
				"App\Repositories\Exam\ExamRepositoryInterface",
				"App\Repositories\Exam\ExamRepository",
				
			);

			app()->singleton(
				"App\Repositories\Result\ResultRepositoryInterface",
				"App\Repositories\Result\ResultRepository",
			);
	}
}
