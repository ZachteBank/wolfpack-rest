<?php

namespace App\Http\Controllers;

use App\Models\Wolf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $storeValidationRules = [
            'name' => 'required|unique:packs|max:255',
            'gender' => 'required|in:male,female',
            'birthday' => 'required|date',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'pack_id' => 'integer|min:0|nullable|exists:App\Models\Pack,id',
        ];
        parent::__construct(Wolf::class, $storeValidationRules);

    }
}
