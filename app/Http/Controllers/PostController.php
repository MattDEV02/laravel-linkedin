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
      $path = Post::pubblicazione($utente_id, $req);
      Log::debug("New Post Inserted ($path).");
      return view('feed.utils.posts', [
         'posts' => Post::getAll($utente_id, false),
         'profile_id' => null
      ]);
   }

   public function like(Request $req): Factory | View | Application {
      $this->utente =
         $req
            ->session()
            ->get('utente');
      $utente_id = $this->utente->id;
      MiPiace::like($req->input('post'), $req->input('utente'));
      $profile_id = $req->input('profile_id');
      $cond =  $profile_id > 0;
      $id = $cond ? $profile_id : $utente_id;
      $posts = Post::getAll($id, $cond);
      return view('feed.utils.posts', [
         'posts' => $posts,
         'profile_id' => $profile_id
      ]);
   }
   public function orderBy(Request $req): Factory | View | Application
   {
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
      $utente_id = $this->utente->id;
      $profile_id = $req->profile_id;
      $cond = $profile_id > 0;
      $orderBy = $req->input('postsOrderName') . ' ' . $req->input('postsOrderType');
      return view('feed.utils.posts', [
         'posts' => Post::getAll($utente_id, $cond, $orderBy),
         'profile_id' => $profile_id
      ]);
   }
}
