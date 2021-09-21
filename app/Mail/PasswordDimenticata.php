<?php

   namespace App\Mail;

   use Illuminate\Bus\Queueable;
   use Illuminate\Contracts\Queue\ShouldQueue;
   use Illuminate\Mail\Mailable;
   use Illuminate\Queue\SerializesModels;


   class PasswordDimenticata extends Mailable {

      use Queueable, SerializesModels;

      /**
       * Create a new message instance.
       *
       * @return void
       */
      public function __construct(string $password)
      {
         //
      }

      /**
       * Build the message.
       *
       * @return $this
       */
      public function build(): static {
         return $this
            ->view('utils.password-dimenticata')
            ;
      }
   }
