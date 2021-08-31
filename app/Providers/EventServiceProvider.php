<?php

   namespace App\Providers;

   use Illuminate\Auth\Events\Registered;
   use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
   use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
   use Illuminate\Support\Facades\Event;
   use App\Observers\RichiestaAmiciziaObserver;
   use App\Observers\CommentoObserver;
   use App\Observers\MiPiaceObserver;
   use App\Observers\PostObserver;
   use App\Models\MiPiace;
   use App\Models\Post;
   use App\Models\RichiestaAmicizia;
   use App\Models\Commento;


   class EventServiceProvider extends ServiceProvider {
      /**
       * The event listener mappings for the application.
       *
       * @var array
       */
      protected $listen = [

      ];

      /**
       * Register any events for your application.
       *
       * @return void
       */
      public function boot(): void {
         Post::observe(PostObserver::class);
         Commento::observe(CommentoObserver::class);
         MiPiace::observe(MiPiaceObserver::class);
         RichiestaAmicizia::observe(RichiestaAmiciziaObserver::class);
      }
   }
