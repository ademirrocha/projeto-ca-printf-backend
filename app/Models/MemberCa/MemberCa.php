<?php

namespace App\Models\MemberCa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberCa extends Model
{
    use HasFactory;

    protected $table = 'members_ca';

    protected $fillable = [
    	'name',
    	'role'
    ];
}
