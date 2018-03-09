<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(required={"title", "owner_id"}, type="object", @SWG\Xml(name="Video"))
 */
class Video extends Model
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
    public $slug;

    /**
     * @var string
     * @SWG\Property(enum={"available", "pending", "sold"})
     */
    public $status;

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

    /**
     * @var Owner
     * @SWG\Property()
     */
    public $owner;

    public function owner()
    {
        return $this->belongsTo('App\Models\Owner');
    }

    protected $fillable = ['title', 'owner_id', 'status', 'description', 'filename'];
}
