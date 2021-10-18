<?php

   namespace App\Http\Controllers;

   use Illuminate\Contracts\Foundation\Application;
   use Illuminate\Contracts\View\Factory;
   use Illuminate\Contracts\View\View;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Log;
   use App\Models\MiPiace;
   use App\Models\Post;


   class PostController extends Controller {

      public function feed(Request $req): Factory | View | Application | RedirectResponse {
         if($req->session()->exists('utente')) {
            return view('feed.index', [
               'posts' => Post::getAll($req->session()->get('utente')->id)
            ]);
         } else
            return redirect('/logout');
      }

      public function insert(Request $req): RedirectResponse {
         $mimes = 'jpeg,png,doc,docs,pdf,ico,svg,bmp,web';
         $req->validate([
            'testo' => ['required', 'min:1', 'max:255'],
            'image' => ['required', 'max:2000', "mimes:$mimes"],
         ], [
            'required' => ':attribute is Required.',
            'testo.min' => 'Testo almeno 1 carattere.',
            'testo.max' => 'Testo massimo 255 caratteri.',
            'image.max' => 'File immagine troppo pesante.',
            'image.mimes' => "Insert a valid image (mimes: $mimes).",
         ]);
         $path = Post::pubblicazione($req);
         Log::debug("New Post Inserted ($path).");
         return back()
            ->with('msg', 'Post pubblicato con successo');
      }

      public function like(Request $req): Factory | View | Application {
         $post_id = $req->input('post_id');
         MiPiace::like($post_id,  $req->session()->get('utente')->id);
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
         $orderBy = $req->input('postsOrderName') . ' ' . $req->input('postsOrderType');
         return view('feed.utils.posts', [
            'posts' => Post::getAll($req->session()->get('utente')->id, false, $orderBy)
         ]);
      }
   }
