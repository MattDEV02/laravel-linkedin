<?php

   namespace App\View\Components;

   use Closure;
   use Illuminate\Contracts\Foundation\Application;
   use Illuminate\Contracts\View\Factory;
   use Illuminate\Contracts\View\View;
   use Illuminate\View\Component;


   class Head extends Component
   {
      public string $title;
      public bool $cond;

      /**
       * Create a new component instance.
       *
       * @return void
       */
      public function __construct(string $title, bool $cond = false)
      {
         $this->title = $title;
         $this->cond = $cond;
      }

      /**
       * Get the view / contents that represent the component.
       *
       * @return View|Closure|string
       */
      public function render(): Factory | View | Application {
         return view('components.head');
      }
   }
