<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(required={"title", "body"}, type="object", @SWG\Xml(name="Article"))
 */
class Article extends Model
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
    public $title;

    /**
     * @var string
     * @SWG\Property()
     */
    public $body;

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

    protected $fillable = ['title', 'body'];
}
