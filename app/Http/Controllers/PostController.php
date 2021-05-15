<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Utente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
   private Utente $utente;

   public function insert(Request $req) {
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
      Log::debug('New Post Inserted.');
      return view('feed.utils.posts', [
         'posts' => getAllPosts()
      ]);
   }

   public function like(Request $req) {
      return 'like';
   }
}
