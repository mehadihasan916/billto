<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'email',
        'password',
        'phone',
        'profileImage',
        'picture__input',
        'signature',
        'terms',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'integer',
    ];

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }

    public function paymentGetway()
    {
        return $this->hasOne(PaymentGetway::class);
    }
    public function subscription()
    {
        return $this->hasOne(Subscription::class)->latestOfMany();
    }
    public function used_invoices()
    {
        return $this->hasOne(ComplateInvoiceCount::class);
    }

    public function latestSubscription()
    {
        return $this->hasOne(Subscription::class)->latestOfMany('created_at');
    }
}
