<?php

namespace App\Models;

use App\Models\LikesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory, LikesTrait;

    protected $guarded = ['id'];

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function reports()
    {
        return $this->hasMany('App\Models\Report');
    }

    public function isReport()
    {
        return $this->reports->where('user_id', Auth::user()->id)->count();
    }
}
