<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Support\Facades\URL;
use App\Notifications\PasswordResetNotification;

class User extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_users', 'user_id', 'event_id');
    }

    public static function getAllExceptLoggedIn()
    {
        $loggedUserId = Auth::id();

        return self::where('id', '!=', $loggedUserId)->get();
    }

    //////////////////

    public function sendPasswordResetNotification($token): void
    {
        $url = URL::to('/reset-password/' . $token);

        $this->notify(new PasswordResetNotification($url));
    }

}
