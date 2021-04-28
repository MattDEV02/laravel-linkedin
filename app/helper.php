<?php

if(
   !function_exists('selectors')
) {
   function selectors(): array {
      return [
         'lang' =>  str_replace('_', '-', app()->getLocale()),
         'dir' => 'ltr',
         'charset' => 'UTF-8',
         'author' => 'Matteo Lambertucci <matteolambertucci3@gmail.com>',
         'container' => 'container-fluid',
         'col' => 'col-12 mt-',
         'row' => 'row justify-content-center',
         'fw' => 'font-weight-bold',
         'input' => 'form-control form-control-lg border border-dark inputTXT',
         'btn' => 'btn btn-lg',
         'email' => 'email',
         'pass' => 'password'
      ];
   }
}