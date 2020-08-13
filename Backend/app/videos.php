<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class videos extends Model
{
    //
    /**
     * @var mixed
     */
    private $title;
    /**
     * @var mixed
     */
    private $url;
    /**
     * @var mixed|string
     */
    private $created_at;
}
