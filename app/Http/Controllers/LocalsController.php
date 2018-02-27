<?php

namespace Infra\Http\Controllers\Local;

use Illuminate\Http\Request;

use Infra\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Infra\Http\Requests\LocalCreateRequest;
use Infra\Http\Requests\LocalUpdateRequest;
use Infra\Repositories\Local\LocalRepository;
use Infra\Validators\Local\LocalValidator;

/**
 * Class LocalsController.
 *
 * @package namespace Infra\Http\Controllers\Local;
 */
class LocalsController extends Controller
{
    /**
     * @var LocalRepository
     */
    protected $repository;

    /**
     * @var LocalValidator
     */
    protected $validator;

    /**
     * LocalsController constructor.
     *
     * @param LocalRepository $repository
     * @param LocalValidator $validator
     */
    public function __construct(LocalRepository $repository, LocalValidator $validator)
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
        $locals = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $locals,
            ]);
        }

        return view('locals.index', compact('locals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LocalCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(LocalCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $local = $this->repository->create($request->all());

            $response = [
                'message' => 'Local created.',
                'data'    => $local->toArray(),
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
        $local = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $local,
            ]);
        }

        return view('locals.show', compact('local'));
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
        $local = $this->repository->find($id);

        return view('locals.edit', compact('local'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LocalUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(LocalUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $local = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Local updated.',
                'data'    => $local->toArray(),
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
                'message' => 'Local deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Local deleted.');
    }
}
