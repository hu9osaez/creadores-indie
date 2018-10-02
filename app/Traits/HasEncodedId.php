<?php namespace CreadoresIndie\Traits;

use Jenssegers\Optimus\Optimus;

trait HasEncodedId
{
    /** @var Optimus $optimus */
    protected static $optimus;

    public static function bootHasEncodedId()
    {
        self::$optimus = resolve(Optimus::class);
    }

    /**
     * @return int
     */
    public function getEncodedIdAttribute()
    {
        return self::$optimus->encode($this->id);
    }
}
