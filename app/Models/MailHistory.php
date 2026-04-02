<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailHistory extends Model
{
    protected $fillable = [
        'recipient', 'subject', 'body', 'status', 'error_message'
    ];
}
