<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailContent extends Model
{
    protected $table = 'emails';
    protected $fillable = ['subject','email_body','internal_description','cta_link','cta_title',];
}
