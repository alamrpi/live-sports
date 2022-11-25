<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static where(string $string, int $id)
 */
class SportMatch extends Model
{
    protected $table = 'matches';
    use HasFactory;
    protected $fillable = ['sport_id', 'league_id', 'club_id_one', 'club_id_two', 'date', 'time', 'sport_type', 'channel', 'channel_url', 'location', 'location_url', 'description'];
}
