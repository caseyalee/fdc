<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Cashier\Billable;
use Creativeorange\Gravatar\Facades\Gravatar;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }



    public function getCVTAttribute()
    {

        $cvtdata =  env('ACC_ORG_ID'). '-' .env('ACC_PROG_ID'). '-'. env('ACC_MEMBER_PREFIX') . $this->id;
        $cvtdata = strtoupper($cvtdata);
        return sha1($cvtdata);
    }



    public function getAccessMemberIdAttribute()
    {
        return env('ACC_MEMBER_PREFIX').$this->id;
    }



    public function getAvatarAttribute()
    {
        return Gravatar::get($this->email);
    }



    public function getSubscriptionStatusLabelAttribute()
    {
        $status = '';
        if ($this->subscribed('default')) {
            $subscription = $this->subscription('default');
            $status = $subscription->stripe_status;
        }
        return $this->getStatusLabelProperty($status,'text');
    }



    public function getSubscriptionStatusLabelColorAttribute()
    {
        $status = '';
        if ($this->subscribed('default')) {
            $subscription = $this->subscription('default');
            $status = $subscription->stripe_status;
        }
        return $this->getStatusLabelProperty($status,'color');
    }



    public function getStatusLabelProperty($status,$type='color')
    {
        $statuses = array(
            'trialing' => [
                'color' => 'bg-green-100 text-green-800',
                'text' => 'Trial'
            ],
            'active' => [
                'color' => 'bg-green-400 text-green-900',
                'text' => '😀 Active!'
            ],
            'incomplete' => [
                'color' => 'bg-yellow-400 text-yellow-900',
                'text' => 'Incomplete'
            ],
            'incomplete_expired' => [
                'color' => 'bg-red-600 text-white',
                'text' => 'Expired'
            ],
            'past_due' => [
                'color' => 'bg-red-600 text-white',
                'text' => '😔 Past Due'
            ],
            'canceled' => [
                'color' => 'bg-red-600 text-white',
                'text' => '😔 Cancelled'
            ],
            'unpaid' => [
                'color' => 'bg-red-600 text-white',
                'text' => 'Unpaid'
            ],
        );

        if ($type == 'color') {
            if (isset($statuses[$status])) {
                return $statuses[$status]['color'];
            }
            return 'bg-gray-100 text-gray-500';
        } elseif ($type == 'text') {
            if (isset($statuses[$status])) {
                return $statuses[$status]['text'];
            }
            return 'N/A';
        }

    }



}
