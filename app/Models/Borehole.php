<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borehole extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'deposit_id',
        'title',
        'type',
        'condition',
        'level_id',
        'q_liquids',
        'water_cut',
        'oil_density',
        'saved',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'saved' => 'boolean',
    ];

    protected $with = ['deposit', 'level'];

    public function deposit () {
        return $this->hasOne(Deposit::class, 'id', 'deposit_id');
    }

    public function level () {
        return $this->hasOne(Level::class, 'id', 'level_id');
    }
}
