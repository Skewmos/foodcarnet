<?php

namespace App\Data;

class SearchData
{
    /** 
     * @var string
     */
    public $q = '';

   /**
    *
    * @var array
    */ 
    public $categories = [];

    /**
     * @var null|integer
     */

     public $maxPrice;

       /**
     * @var null|integer
     */

    public $inPrice;
}