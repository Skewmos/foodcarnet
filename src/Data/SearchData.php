<?php

namespace App\Data;

class SearchData
{

    /**
     * @var int
     */
    public $page = 1;

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

    public $minPrice;
}