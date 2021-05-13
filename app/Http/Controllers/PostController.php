<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
   public function insert(Request $req) {
      $utente_id = $req->id;
      $fileName = store($req->image, 'posts', $utente_id);
      $post = new Post();
      $post->testo= $req->testo;
      $post->foto = $fileName;
      $post->utente = $utente_id;
      $post->save();
      return view('feed.utils.posts', [
         'posts' => getAllPosts()
      ]);
   }
   public function like(Request $req) {
      return '';
   }
}
