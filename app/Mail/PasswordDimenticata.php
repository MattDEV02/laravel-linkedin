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
         $app_name = env('APP_NAME');
         return $this
            ->from(env('MAIL_USERNAME'), $app_name )
            ->subject("Nuove credenziali account $app_name")
            ->replyTo(env('MAIL_USERNAME'), $app_name )
            ->to('matteolambertucci3@gmail.com') // User name and surname as second parameter...
            ->view('mail.password-dimenticata', [

            ]);
      }
   }
