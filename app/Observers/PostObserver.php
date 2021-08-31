<?php

   namespace App\Observers;

   use App\Models\Post;
   use App\Models\Reportistica;


   class PostObserver {
      /**
       * Handle the Post "created" event.
       *
       * @param Post $post
       * @return void
       */
      public function created(Post $post) {
         Reportistica::updatePost($post->utente_id);
      }

      /**
       * Handle the Post "updated" event.
       *
       * @param Post $post
       * @return void
       */
      public function updated(Post $post) {
         Reportistica::updatePost($post->utente_id);
      }

      /**
       * Handle the Post "deleted" event.
       *
       * @param Post $post
       * @return void
       */
      public function deleted(Post $post) {
         Reportistica::updatePost($post->utente_id);
      }
   }
