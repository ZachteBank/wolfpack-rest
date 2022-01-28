<?php


namespace App\Http\Controllers;


use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;
use function Psy\debug;

/** @template T */
abstract class BaseRestController extends Controller implements IRestController
{
    private $entity;

    private array $storeValidation;

    /**
     * BaseRestController constructor.
     * @param class-string<T> $entity
     */
    public function __construct(string $entity, array $postValidation = [])
    {
        $this->entity = $entity;
        $this->storeValidation = $postValidation;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $all = $this->entity::all();
        return response()->json($all);
    }

    /**
     * @param Request $request
     * @param T $obj
     * @return JsonResponse
     * @throws Exception
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->isJson() && $request->validate($this->storeValidation);
        if (!$validated) {
            throw new Exception("Wrong format", 403);
        }
        $real = $this->entity::create($request->all());
        return response()->json($real);
    }

    public function show($id): JsonResponse
    {
        $obj = $this->entity::findOrFail($id);
        return response()->json($obj);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validated = $request->isJson() && $request->validate($this->storeValidation);
        if (!$validated) {
            throw new Exception("Wrong format", 403);
        }
        $obj = $this->entity::findOrFail($id);

        $obj->update($request->all());
        return response()->json($obj);
    }

    public function destroy($id): JsonResponse
    {
        $this->entity::findOrFail($id)->delete();
        return response()->json([], 204);
    }
}
