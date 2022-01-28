<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\Wolf;
use Illuminate\Http\Request;

class PackController extends BaseRestController
{

    /**
     * PackController constructor.
     */
    public function __construct()
    {
        $storeValidationRules = [
            'name' => 'required|unique:packs|max:255',
        ];
        parent::__construct(Pack::class, $storeValidationRules);
    }

    public function getWolvesByPackId($packId)
    {
        $pack = Pack::findOrFail($packId);
        $wolves = $pack->getAllWolves();
        return response()->json($wolves);
    }
}
