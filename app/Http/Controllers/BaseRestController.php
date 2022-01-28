<?php


namespace App\Http\Controllers;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/** @template T */
abstract class BaseRestController extends Controller implements IRestController
{
    private $entity;

    private array $storeValidation;
    private array $updateValidation;
 protected readonly $idValidation = ["id" => 'required|integer|min:0'];

    /**
     * BaseRestController constructor.
     * @param $entity T extends Model
     */
    public function __construct($entity, array $postValidation = [], array $updateValidation = [])
    {
        $this->entity = $entity;
        $this->storeValidation = $postValidation;
        $this->updateValidation = $updateValidation;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $all = $this->entity::all();
        return response()->json($all);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate($this->storeValidation);

    }

    public function show($id): JsonResponse
    {
        $obj = $this->entity::query()->where('id', '==', $id);
        return response()->json($obj);
    }

    public function update(Request $request, $id): JsonResponse
    {
        // TODO: Implement update() method.
    }

    public function destroy($id): JsonResponse
    {
        // TODO: Implement destroy() method.
    }
}
