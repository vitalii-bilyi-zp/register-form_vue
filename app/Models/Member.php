<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;

    const IMAGES_FOLDER = 'members';

    const DEFAULT_IMAGE_PATH = 'storage/images/default.jpg';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'birthdate', 'report', 'country_id', 'phone', 'email', 'company', 'position', 'about', 'original_file_name', 'hash_file_name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birthdate' => 'date',
    ];
}
