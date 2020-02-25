<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MakeModel extends Model
{
    protected $table = "models";

    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'name', 'value', 'status', 'make_id', 'created_at', 'updated_at',
    ];
}
