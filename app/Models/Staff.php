<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /* Table name, because laravel looks for table of class name + 's'
        for example here, by default it looks for table called 'staffs' so we need to give it the actual name
    */
    protected $table = 'staff';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'staff_id'; /* By default, it looks for primary key called id, so we have to specify here */

    protected $attributes = [
        'is_admin' => false,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'contact_no',
        'hashed_pass',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'hashed_pass',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'hashed_pass' => 'hashed',
    ];
}
