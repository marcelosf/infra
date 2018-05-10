<?php

namespace Infra\Http\Controllers\Devices;

use Infra\Events\SwitchCreated;
use Infra\Http\Controllers\Controller;
use Infra\Http\Requests;
use Infra\Http\Requests\Devices\SwitchesCreateRequest;
use Infra\Http\Requests\Devices\SwitchesUpdateRequest;
use Infra\Repositories\Devices\SwitchesRepositoryEloquent;
use Infra\Validators\Devices\SwitchesValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


class SwitchesController extends Controller
{

    protected $repository;


    protected $validator;


    public function __construct(SwitchesRepositoryEloquent $repository, SwitchesValidator $validator)
    {

        $this->repository = $repository;

        $this->validator  = $validator;

    }


    public function index()
    {

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $switches = $this->repository->paginate(20);

        if (request()->wantsJson()) {

            return response()->json([

                'data' => $switches,

            ]);

        }

        return view('switches.index', compact('switches'));
    }


    public function store(SwitchesCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $switch = $this->repository->create($request->all());

            if ($switch) {

                event(new SwitchCreated($switch));

            }

            $response = [

                'message' => 'Switch created.',

                'data'    => $switch->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }


        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([

                    'error'   => true,

                    'message' => $e->getMessageBag()

                ]);

            }

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
        $switch = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $switch,
            ]);
        }

        return view('switches.show', compact('switch'));
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
        $switch = $this->repository->find($id);

        return view('switches.edit', compact('switch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SwitchesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SwitchesUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $switch = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Switches updated.',
                'data'    => $switch->toArray(),
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
                'message' => 'Switches deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Switches deleted.');
    }
}
