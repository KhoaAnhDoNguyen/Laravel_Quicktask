<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    //Accessor, Mutator
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->attributes['username'] . ' ' . $this->attributes['password']
        );
    }      

    protected function userName(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::slug($value)
        );
    } 
}
