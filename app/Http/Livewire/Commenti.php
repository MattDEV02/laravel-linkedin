<?php

   namespace App\Http\Livewire;

   use App\Models\Commento;
   use Illuminate\Contracts\Foundation\Application;
   use Illuminate\Contracts\View\Factory;
   use Illuminate\Contracts\View\View;
   use Illuminate\Support\Collection;
   use Illuminate\Support\Str;
   use Livewire\Component;


   class Commenti extends Component {

      public array | Collection $commenti;
      public array | object $post;

      public string $testo;
      public bool $newComment;


      public function mount(): void {
         $this->testo = '';
      }

      public function pubblicazione(int $post_id): void {
         $len = Str::length($this->testo);
         if($len > 0 && $len < 255) {
            $commento = new Commento();
            $commento->post_id = $post_id;
            $commento->utente_id = session()->get('utente')->id;
            $commento->testo = $this->testo;
            $commento->save();
            $this->testo = '';
            $this->refresh($post_id);
            $this->newComment = true;
         }
      }

      public function refresh(int $post_id): void {
         $this->commenti = Commento::getAllByPost($post_id);
      }

      public function render(): Factory | View | Application {
         return view('livewire.commenti');
      }
   }
