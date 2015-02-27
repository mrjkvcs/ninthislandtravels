<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {

    protected $fillable = [
        'product_id',
        'first_name',
        'middle_name',
        'last_name',
        'birthdate_at',
        'gender',
        'place_of_birth',
        'nationality',
        'email',
        'address',
        'phone_home',
        'phone_work',
        'phone_cell',
    ];
}