<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @SWG\Definition(required={"title", "owner_id"}, type="object", @SWG\Xml(name="Video"))
 *
 * @SWG\Property(property="id",         type="integer",   description="Unique identifier for the Video", format="int64")
 * @SWG\Property(property="title",      type="string",    description="Title of the video")
 * @SWG\Property(property="slug",       type="string",    description="Slug of the video")
 * @SWG\Property(property="filename",   type="string",    description="Filename of the video")
 * @SWG\Property(property="owner_id",   type="integer",   description="Owner ID of the video")
 * @SWG\Property(property="owner",      ref="#/definitions/Owner",   description="Owner of the video")
 * @SWG\Property(property="created_at", type="string", format="YYYY-mm-dd HH:mm:ss", readOnly=true,  description="Datetime create of the article")
 * @SWG\Property(property="status",     description="Encoding status",  enum={"new", "available", "process", "unavailable"})
 */
class Video extends Model
{
    /**
     * Doesn't working with any value
     * Use AppServiceProvider event
     *
     * @var bool
     */
    //public $timestamps = true;

    /**
     *
     * @return App\Models\Owner
     */
    public function owner()
    {
        return $this->belongsTo('App\Models\Owner');
    }

    protected $fillable = ['title', 'owner_id', 'status', 'description', 'filename', 'slug'];

    protected $hidden = ['updated_at', 'deleted_at'];
}
