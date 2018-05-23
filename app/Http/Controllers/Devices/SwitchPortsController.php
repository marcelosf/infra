<?php

namespace Infra\Http\Controllers\Devices;

use Infra\Http\Controllers\Controller;
use Infra\Http\Requests;
use Infra\Http\Requests\Devices\SwitchPortsCreateRequest;
use Infra\Http\Requests\Devices\SwitchPortsUpdateRequest;
use Infra\Repositories\Devices\SwitchPortsRepositoryEloquent;
use Infra\Validators\Devices\SwitchPortsValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class SwitchPortsController.
 *
 * @package namespace Infra\Http\Controllers\Devices;
 */
class SwitchPortsController extends Controller
{

    protected $repository;

    protected $validator;


    public function __construct(SwitchPortsRepositoryEloquent $repository, SwitchPortsValidator $validator)
    {

        $this->repository = $repository;

        $this->validator  = $validator;

    }


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


    public function update(SwitchPortsUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $switchPort = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Porta do switch atualizada.',
                'data'    => $switchPort,
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
