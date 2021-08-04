<?php

   namespace App\Http\Livewire;

   use App\Models\Commento;
   use Illuminate\Contracts\Foundation\Application;
   use Illuminate\Contracts\View\Factory;
   use Illuminate\Contracts\View\View;
   use Illuminate\Support\Collection;
   use Livewire\Component;


   class Commenti extends Component {

      public array | Collection $commenti;
      public array $post;

      public string $testo;

      public function mount(): void {
         $this->testo = '';
      }

      public function pubblicazione(int $post_id): void {
         $commento = new Commento();
         $commento->testo = $this->testo;
         $commento->post = $post_id;
         $commento->utente = session()->get('utente')->id;
         $commento->save();
         $this->refresh($post_id);
      }

      public function refresh(int $post_id): void {
         $this->testo = '';
         $this->commenti = Commento::getAllByPost($post_id);
      }

      public function render(): Factory | View | Application {
         return view('livewire.commenti', [
            'commenti' =>  Commento::getAllByPost(1)
         ]);
      }
   }
