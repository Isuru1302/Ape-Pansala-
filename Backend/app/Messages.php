<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    //
    /**
     * @var mixed
     */
    private $full_name;
    /**
     * @var mixed
     */
    private $email;
    /**
     * @var mixed
     */
    private $message;
    /**
     * @var int|mixed
     */
    private $read_unread;
}
