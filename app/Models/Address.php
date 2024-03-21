<?php

namespace App\Models;

use App\Models\User;
use App\Models\State;
use App\Models\Country;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasApiTokens,HasFactory;
    protected $fillable = [
        'user_id',
        'address_type',
        'address_line_1',
        'address_line_2',
        'city',
        'post_office',
        'rail_station',
        'police_station',
        'district',
        'state_id',
        'country_id',
        'pincode',
        'latitude',
        'longitude',
    ];
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
    public function state()
    {
        return $this->belongsTo(State::class )->withDefault();
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public static function display()
    {
        return "Full Address";
    }

}
