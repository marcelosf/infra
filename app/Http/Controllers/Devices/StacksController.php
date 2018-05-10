<?php

namespace Infra\Http\Controllers\Devices;

use Infra\Http\Requests;
use Infra\Http\Requests\Devices\StackCreateRequest;
use Infra\Http\Requests\Devices\StackUpdateRequest;
use Infra\Repositories\Devices\StackRepositoryEloquent;
use Infra\Validators\Devices\StackValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Infra\Http\Controllers\Controller;


class StacksController extends Controller
{

    protected $repository;


    protected $validator;


    public function __construct(StackRepositoryEloquent $repository, StackValidator $validator)
    {

        $this->repository = $repository;

        $this->validator  = $validator;

    }


    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $stacks = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([

                'data' => $stacks,
            ]);
        }

    }


    public function store(StackCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $stack = $this->repository->firstOrCreate(['hostname' => $request->hostname], $request->all());

            $response = [

                'message' => 'Stack created.',

                'data'    => $stack->toArray(),

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
        $stack = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $stack,
            ]);
        }

        return view('stacks.show', compact('stack'));
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
        $stack = $this->repository->find($id);

        return view('stacks.edit', compact('stack'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StackUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(StackUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $stack = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Stack updated.',
                'data'    => $stack->toArray(),
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
                'message' => 'Stack deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Stack deleted.');
    }
}
