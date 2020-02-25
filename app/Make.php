<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Make extends Model {

    protected $table = "makes";

    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'name', 'status', 'created_at', 'updated_at',
    ];

}
