<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'follows';

    public $timestamps = false;

    protected $fillable = [
        'follower_id', 
        'followee_id', 
        'followed_at'
    ];

    protected $primaryKey = ['follower_id', 'followee_id'];

    // Define the primary key as a composite key
    protected $keyType = 'string';

    // Disable the auto-incrementing ID as we use composite key
    public $incrementing = false;

    public function getKeyName()
    {
        return 'follower_id';
    }

    public function getKeyType()
    {
        return 'followee_id';
    }
}


