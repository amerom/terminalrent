<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Terminals extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_terminals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'terminal_id',
        'user_id',
        'from',
        'to'
    ];

    public function user()
    {
        return $this->belongsToMany('App\User', 'id', 'user_id');
    }

}
