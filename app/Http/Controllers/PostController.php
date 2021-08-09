<?php

   namespace App\Http\Controllers;

   use App\Models\Commento;
   use Illuminate\Contracts\Foundation\Application;
   use Illuminate\Contracts\View\Factory;
   use Illuminate\Contracts\View\View;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Log;
   use App\Models\MiPiace;
   use App\Models\Post;
   use App\Models\Utente;


   class PostController extends Controller {

      private ?Utente $utente;

      public function insert(Request $req): Factory | View | Application {
         $req->validate([
            'testo' => ['required', 'min:1', 'max:255'],
            'image' => ['required', 'max:2000', 'mimes:jpeg,png,doc,docs,pdf,ico,svg,bmp,web'],
         ], [
            'required' => ':attribute is Required.',
            'testo.min' => 'Testo almeno 1 carattere.',
            'testo.max' => 'Testo massimo 255 caratteri.',
            'image.max' => 'File immagine troppo pesante.',
            'image.mimes'  => 'Insert a valid image.',
         ]);
         $this->utente =
            $req
               ->session()
               ->get('utente');
         $utente_id = $this->utente->id;
         $path = Post::pubblicazione($req);
         Log::debug("New Post Inserted ($path).");
         return view('feed.utils.posts', [
            'posts' => Post::getAll($utente_id, false)
         ]);
      }

      public function like(Request $req): Factory | View | Application {
         $this->utente =
            $req
               ->session()
               ->get('utente');
         $post_id = $req->input('post_id');
         MiPiace::like($post_id, $this->utente->id);
         return view('components.like', [
            'postId' => $post_id
         ]);
      }

      public function orderBy(Request $req): Factory | View | Application {
         $req->validate([
            'postsOrderName' => ['required', 'min:7', 'max:12'],
            'postsOrderType' => ['required', 'min:3', 'max:4'],
         ], [
            'postsOrderName.required' => 'Posts order name is required.',
            'postsOrderName.min' => 'Posts order name min 7 characters.',
            'postsOrderName.max' => 'Posts order name max 12 characters.',
            'postsOrderType.required' => 'Posts order type is required.',
            'postsOrderType.min' => 'Posts order type min 3 characters.',
            'postsOrderType.max' => 'Posts order type max 4 characters.',
         ]);
         $this->utente =
            $req
               ->session()
               ->get('utente');
         $orderBy = $req->input('postsOrderName') . ' ' . $req->input('postsOrderType');
         return view('feed.utils.posts', [
            'posts' => Post::getAll($this->utente->id, false, $orderBy)
         ]);
      }

      public function commenti(Request $req, int $post_id): Factory | View | Application | RedirectResponse {
         $this->utente = $req
            ->session()
            ->get('utente');
         $commenti = Commento::getAllByPost($post_id);
         $post = Post::getWithAuthor($post_id);
         return isValidCollection($post) ? view('commenti.index', [
            'commenti' => $commenti,
            'post' => $post
         ]) : back();
      }
   }
