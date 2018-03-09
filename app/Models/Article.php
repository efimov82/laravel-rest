<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(required={"title", "body"}, type="object", @SWG\Xml(name="Article"))
 */
class Article extends Model
{
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

    protected $fillable = ['title', 'body'];
}
