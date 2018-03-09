<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(required={"full_name", "email"}, type="object", @SWG\Xml(name="Owner"))
 */
class Owner extends Model
{
  /**
     * @var integer
     * @SWG\Property()
     */
    public $id;

    /**
     * @var string
     * @SWG\Property()
     */
    public $full_name;

    /**
     * @var string
     * @SWG\Property()
     */
    public $email;

    /**
     * @var string
     * @SWG\Property()
     */
    public $slug;

    /**
     * @var DateTime
     * @SWG\Property()
     */
    public $created_at;

    /**
     * @var DateTime
     * @SWG\Property()
     */
    public $updated_at;

    protected $fillable = ['full_name', 'email'];
}
