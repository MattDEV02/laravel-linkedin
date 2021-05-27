<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\MiPiace;
use App\Models\Post;
use App\Models\Utente;


class PostController extends Controller
{
   private ?Utente $utente;

   public function insert(Request $req): Factory | View | Application {
      $req->validate([
         'testo' => ['required', 'min:2', 'max:255'],
         'image' => ['required', 'image'],
      ], [
         'testo.required' => 'Testo is Required.',
         'testo.min' => 'Testo almeno 2 caratteri.',
         'testo.max' => 'Testo massimo 255 caratteri.',
         'image.required'  => 'Image is Required.',
         'image.image'  => 'Insert valid Image.',
      ]);
      $this->utente =
         $req
            ->session()
            ->get('utente');
      $utente_id = $this->utente->id;
      $fileName = store($req->image, 'posts', $utente_id);
      $post = new Post();
      $post->testo= $req->testo;
      $post->foto = $fileName;
      $post->utente = $utente_id;
      $post->save();
      Log::debug("New Post Inserted ($fileName).");
      return view('feed.utils.posts', [
         'posts' => getAllPosts($utente_id, false),
         'profile_id' => null
      ]);
   }

   public function like(Request $req): Factory | View | Application {
      $this->utente =
         $req
            ->session()
            ->get('utente');
      $utente_id = $this->utente->id;
      $miPiace = new MiPiace();
      $miPiace->post = $req->post;
      $miPiace->utente = $req->utente;
      $miPiace->save();
      $profile_id = $req->profile_id;
      $cond =  $profile_id > 0;
      $id = $cond ? $profile_id : $utente_id;
      $posts = getAllPosts($id, $cond);
      return view('feed.utils.posts', [
         'posts' => $posts,
         'profile_id' => $profile_id
      ]);
   }
}
