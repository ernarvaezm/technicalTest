<?php

namespace App;
/**
 * @SWG\Definition(@SWG\Xml(name="User"))
 */
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
  * @SWG\Property
  * @var string
  */
  private $name;
  /**
* @SWG\Property
* @var string
*/
private $password;
 /**
  * @SWG\Property
  * @var string
  */
  private $email;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
