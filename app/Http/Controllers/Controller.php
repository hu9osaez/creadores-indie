<?php namespace CreadoresIndie\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Jenssegers\Optimus\Optimus;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var Optimus $optimus
     */
    protected $optimus;

    /**
     * Create a new controller instance.
     *
     * @param  Optimus  $optimus
     * @return void
     */
    public function __construct(Optimus $optimus)
    {
        $this->optimus = $optimus;
    }
}
