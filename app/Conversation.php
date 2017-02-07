<?php

namespace App;

use App\User;
use App\Message;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['user1_id', 'user2_id'];

    protected $hidden = ['user1_id', 'user2_id', 'user1', 'user2'];

    protected $appends = ['peer'];

    public function user1()
    {
        return $this->belongsTo(User::class);
    }

    public function user2()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function send(Message $message)
    {
        $this->messages()->save($message);
    }

    public static function of(User $user)
    {
        return static::where(function($query) use($user) {
            $query->where('user1_id', $user->id);
            $query->orWhere('user2_id', $user->id);
        })->get();
    }

    public function getPeerAttribute()
    {
        $this->load(['user1', 'user2']);

        if ($this->user1_id == request()->user()->id) {
            return $this->user2;
        }

        return $this->user1;
    }
}
