<?php

namespace App\Models;

use App\Http\Resources\AuthUserResource;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
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

    public function user_role(){
        return $this->belongsTo( UserRole::class );
    }

    public function setAndGetLoginResponse($token = null, $additional = [])
    {
        AuthUserResource::withoutWrapping();

        if ( $token === null ) {
            $token = $this->loginAndGetToken();
        }

        return [
                'user'  => (new AuthUserResource($this)),
                'token' => $token,
            ] + $additional;
    }

    public function loginAndGetToken()
    {

        $abilities = json_decode($this->user_role->abilities ?? '', true );

        return $this->createToken(request()->ip(),
            is_array($abilities) ?  $abilities: ['*']
        )->plainTextToken;
    }



}
