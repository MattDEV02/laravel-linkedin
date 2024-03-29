<?php

   namespace App\View\Components;

   use Closure;
   use Illuminate\Contracts\View\View;
   use Illuminate\View\Component;


   class Commento extends Component {

      public string $autoreCommento; // nome cognome
      public string $autoreEmailCommento;
      public string $dataCommento;
      public string $testoCommento;
      /**
       * Create a new component instance.
       *
       * @return void
       */
      public function __construct(string $autoreCommento, string $dataCommento, string $testoCommento, string $autoreEmailCommento) {
         $this->autoreCommento = $autoreCommento;
         $this->dataCommento = $dataCommento;
         $this->testoCommento = $testoCommento;
         $this->autoreEmailCommento = $autoreEmailCommento;
      }

      /**
       * Get the view / contents that represent the component.
       *
       * @return View|Closure|string
       */
      public function render(): View | string | Closure
      {
         return view('components.commento');
      }
   }
