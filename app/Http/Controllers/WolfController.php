<?php

namespace App\Http\Controllers;

use App\Models\Wolf;
use Illuminate\Http\Request;

/**
 * Class WolfController
 * @package App\Http\Controllers
 * @template-extends BaseRestController<Wolf>
 */
class WolfController extends BaseRestController
{

    /**
     * WolfController constructor.
     */
    public function __construct()
    {
        parent::__construct(Wolf::class);
    }
}
