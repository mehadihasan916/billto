<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class Traffic extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip',
        'details',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public static function set(Request $request)
    {
        // Check session first
        if (!$request->session()->has('visitor_ip')) {  //check session ip

            $ip = $request->ip();

            // Check DB for today's visit
            $exists = self::where('ip', $ip)
                ->whereDate('created_at', today())
                ->exists();

            if (!$exists) {
                // Get location info
                $location = Location::get($ip);

                // Save to DB
                self::create([
                    'ip' => $ip,
                    'details' => json_encode($location),
                    'user_id' => auth()->check() ? auth()->id() : null
                ]);
            }

            // Save IP in session
            $request->session()->put('visitor_ip', $ip);
        }
    }
}
