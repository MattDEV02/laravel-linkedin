<?php

   namespace App\View\Components;

   use Closure;
   use Illuminate\Contracts\Foundation\Application;
   use Illuminate\Contracts\View\Factory;
   use Illuminate\Contracts\View\View;
   use Illuminate\View\Component;


   class RichiestaBTN extends Component
   {
      public bool $cond = false;
      public int $utenteMittente;
      public int $utenteRicevente;
      /**
       * Create a new component instance.
       *
       * @return void
       */
      public function __construct(int $utenteMittente, int $utenteRicevente, bool $cond = false)
      {
         $this->cond = $cond;
         $this->utenteMittente = $utenteMittente;
         $this->utenteRicevente = $utenteRicevente;
      }

      /**
       * Get the view / contents that represent the component.
       *
       * @return View|Closure|string
       */
      public function render(): Factory | View | Application {
         return view('components.richiesta-b-t-n');
      }
   }
