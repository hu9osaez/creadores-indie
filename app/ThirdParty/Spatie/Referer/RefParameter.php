<?php namespace CreadoresIndie\ThirdParty\Spatie\Referer;

use Illuminate\Http\Request;
use Spatie\Referer\Source;

class RefParameter implements Source
{
    public function getReferer(Request $request): string
    {
        return $request->get('ref', '');
    }
}
