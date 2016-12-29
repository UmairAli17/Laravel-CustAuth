<?php
     
     if (! function_exists('text_limit')){
     /* Limit the number of words in a string.*/
	
	 /**
     * Limit the number of words in a string.
     *
     * @param  string  $value
     * @param  int     $words
     * @param  string  $end
     * @return string
     */

          function text_limit($value, $limit = 100, $end = '...')
          {
               return \Illuminate\Support\Str::words($value, $limit, $end);
          }
     }

