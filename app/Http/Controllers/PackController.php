<?php

namespace App\Http\Controllers;

use App\Models\Pack;
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
        $updateValidationRules = [
            'id' => 'required|integer|min:0'
        ]
        parent::__construct(Pack::class);
    }
}
