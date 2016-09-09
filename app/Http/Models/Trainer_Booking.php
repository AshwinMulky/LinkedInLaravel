<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainer_Booking extends Model
{
    protected $fillable = ['trainer_id', 'booking_date', 'from_time', 'to_time', 'subject'];
}
