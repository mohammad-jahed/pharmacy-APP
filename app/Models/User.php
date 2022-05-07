<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @method void assignRole();
 * @method void givePermissionTo();
 */
class User extends Authenticatable implements JWTSubject
{


    use Notifiable, HasTranslations, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $table = 'user';
    protected $fillable = [
        'name', 'email', 'password', 'username', 'imagePath'
    ];


    public array $translatable = ['name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    protected function workTime(): HasOne
    {
        return $this->hasOne(WorkTime::class);
    }

    protected function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    protected function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'receiver_id');
    }

    protected function medicines(): HasMany
    {
        return $this->hasMany(Medicine::class);
    }

    protected function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    protected function reservationUsers(): HasMany
    {
        return $this->hasMany(ReservationUser::class);
    }

    protected function role(): HasOne
    {
        return $this->hasOne(Role::class);
    }

}
