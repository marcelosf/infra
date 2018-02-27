<?php

namespace Infra\Http\Controllers\Infra;

use Illuminate\Http\Request;

use Infra\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Infra\Http\Requests\PatchCreateRequest;
use Infra\Http\Requests\PatchUpdateRequest;
use Infra\Repositories\Infra\PatchRepository;
use Infra\Validators\Infra\PatchValidator;

/**
 * Class PatchesController.
 *
 * @package namespace Infra\Http\Controllers\Infra;
 */
class PatchesController extends Controller
{
    /**
     * @var PatchRepository
     */
    protected $repository;

    /**
     * @var PatchValidator
     */
    protected $validator;

    /**
     * PatchesController constructor.
     *
     * @param PatchRepository $repository
     * @param PatchValidator $validator
     */
    public function __construct(PatchRepository $repository, PatchValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $patches = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $patches,
            ]);
        }

        return view('patches.index', compact('patches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PatchCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PatchCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $patch = $this->repository->create($request->all());

            $response = [
                'message' => 'Patch created.',
                'data'    => $patch->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patch = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $patch,
            ]);
        }

        return view('patches.show', compact('patch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patch = $this->repository->find($id);

        return view('patches.edit', compact('patch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PatchUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PatchUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $patch = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Patch updated.',
                'data'    => $patch->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Patch deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Patch deleted.');
    }
}
