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
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @method void assignRole($role);
 * @method void givePermissionTo();
 * @property void medicines;
 * @method  static Builder type($type);
 *
 * @property int id;
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

    public function workTime(): HasOne
    {
        return $this->hasOne(WorkTime::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'receiver_id');
    }

    public function medicines(): BelongsToMany
    {
        return $this->belongsToMany(Medicine::class, 'medicine_users', 'pharmacy_id', 'medicine_id')->as('medicine user');
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

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class, 'reservation_users', 'user_id', 'reservation_id')->as('reservation_user');
    }

}
