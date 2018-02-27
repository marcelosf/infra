<?php

namespace Infra\Http\Controllers\Infra;

use Illuminate\Http\Request;

use Infra\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Infra\Http\Requests\RackCreateRequest;
use Infra\Http\Requests\RackUpdateRequest;
use Infra\Repositories\Infra\RackRepository;
use Infra\Validators\Infra\RackValidator;

/**
 * Class RacksController.
 *
 * @package namespace Infra\Http\Controllers\Infra;
 */
class RacksController extends Controller
{
    /**
     * @var RackRepository
     */
    protected $repository;

    /**
     * @var RackValidator
     */
    protected $validator;

    /**
     * RacksController constructor.
     *
     * @param RackRepository $repository
     * @param RackValidator $validator
     */
    public function __construct(RackRepository $repository, RackValidator $validator)
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
        $racks = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $racks,
            ]);
        }

        return view('racks.index', compact('racks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RackCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(RackCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $rack = $this->repository->create($request->all());

            $response = [
                'message' => 'Rack created.',
                'data'    => $rack->toArray(),
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
        $rack = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $rack,
            ]);
        }

        return view('racks.show', compact('rack'));
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
        $rack = $this->repository->find($id);

        return view('racks.edit', compact('rack'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RackUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(RackUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $rack = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Rack updated.',
                'data'    => $rack->toArray(),
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
                'message' => 'Rack deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Rack deleted.');
    }
}
