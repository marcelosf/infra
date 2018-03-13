<?php

namespace Infra\Http\Controllers\Devices;

use Illuminate\Http\Request;

use Infra\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Infra\Http\Requests\SwitchPortsCreateRequest;
use Infra\Http\Requests\SwitchPortsUpdateRequest;
use Infra\Repositories\Devices\SwitchPortsRepository;
use Infra\Validators\Devices\SwitchPortsValidator;

/**
 * Class SwitchPortsController.
 *
 * @package namespace Infra\Http\Controllers\Devices;
 */
class SwitchPortsController extends Controller
{
    /**
     * @var SwitchPortsRepository
     */
    protected $repository;

    /**
     * @var SwitchPortsValidator
     */
    protected $validator;

    /**
     * SwitchPortsController constructor.
     *
     * @param SwitchPortsRepository $repository
     * @param SwitchPortsValidator $validator
     */
    public function __construct(SwitchPortsRepository $repository, SwitchPortsValidator $validator)
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
        $switchPorts = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $switchPorts,
            ]);
        }

        return view('switchPorts.index', compact('switchPorts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SwitchPortsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SwitchPortsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $switchPort = $this->repository->create($request->all());

            $response = [
                'message' => 'SwitchPorts created.',
                'data'    => $switchPort->toArray(),
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
        $switchPort = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $switchPort,
            ]);
        }

        return view('switchPorts.show', compact('switchPort'));
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
        $switchPort = $this->repository->find($id);

        return view('switchPorts.edit', compact('switchPort'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SwitchPortsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SwitchPortsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $switchPort = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'SwitchPorts updated.',
                'data'    => $switchPort->toArray(),
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
                'message' => 'SwitchPorts deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'SwitchPorts deleted.');
    }
}
