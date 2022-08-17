<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int id;
 * @property void medicines;
 * @property void address;
 * @property void userReservations;
 * @property void pharmacyReservations;
 * @property void notifications;
 * @property string username;
 * @method void assignRole($role);
 * @method void givePermissionTo();
 * @method static Builder type($type);
 * @property void unreadNotifications;
 * @property void readNotifications;
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
        'email', 'password', 'username', 'imagePath' , 'contact_information'
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
        'contact_information'=>'array'
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

    public function workTime(): HasOne
    {
        return $this->hasOne(WorkTime::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }


    public function medicines(): BelongsToMany
    {
        return $this->belongsToMany(Medicine::class, 'medicine_users', 'pharmacy_id', 'medicine_id')->as('medicine_user');
    }

    public function reservationUsers(): HasMany
    {
        return $this->hasMany(ReservationUser::class);
    }


    public function scopeType(Builder $query, $userType): Builder
    {
        return $query->role(Role::query()->where('name', 'like', $userType)->get());
    }

    public function password(): Attribute
    {
        return new Attribute(
            set: fn($password) => Hash::make($password)
        );
    }

    public function pharmacyReservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'pharmacy_id');
    }

    public function userReservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'user_id');
    }



    public function FcmTokens(): HasMany
    {
        return $this->hasMany(FcmToken::class);
    }

    public function routeNotificationForFcm($notification = null): array
    {
        return $this->FcmTokens()->pluck('token')->toArray();
    }


}
