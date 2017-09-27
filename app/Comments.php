<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
        'parent_id',
        'target_table',
        'target_id',
        'contents',
    ];

    protected $dates = [
        'insert_dt',
        'update_dt',
    ];

    /* Relationships */
    public function commentable(){
        return $this->morpTo();
    }

    public function child()
    {
        return $this->hasMany(Comments::class, 'parent_id');
    }
}
