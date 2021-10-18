<?php

   namespace App\Http\Controllers;

   use App\Models\Commento;
   use App\Models\Post;
   use Illuminate\Contracts\Foundation\Application;
   use Illuminate\Contracts\View\Factory;
   use Illuminate\Contracts\View\View;
   use Illuminate\Http\RedirectResponse;
   use Illuminate\Http\Request;


   class CommentiController extends Controller {
      public function commenti(Request $req, int $post_id): Factory | View | Application | RedirectResponse {
         $req->session()->put('cond', true);
         $commenti = Commento::getAllByPost($post_id);
         $post = Post::getWithAuthor($post_id);
         return isValidCollection($post) ? view('commenti.index', [
            'commenti' => $commenti,
            'post' => $post
         ]) : back();
      }
   }
