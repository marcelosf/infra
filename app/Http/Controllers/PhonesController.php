<?php

namespace Infra\Http\Controllers\Infra;

use Illuminate\Http\Request;

use Infra\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Infra\Http\Requests\PhonesCreateRequest;
use Infra\Http\Requests\PhonesUpdateRequest;
use Infra\Repositories\Infra\PhonesRepository;
use Infra\Validators\Infra\PhonesValidator;

/**
 * Class PhonesController.
 *
 * @package namespace Infra\Http\Controllers\Infra;
 */
class PhonesController extends Controller
{
    /**
     * @var PhonesRepository
     */
    protected $repository;

    /**
     * @var PhonesValidator
     */
    protected $validator;

    /**
     * PhonesController constructor.
     *
     * @param PhonesRepository $repository
     * @param PhonesValidator $validator
     */
    public function __construct(PhonesRepository $repository, PhonesValidator $validator)
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
        $phones = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $phones,
            ]);
        }

        return view('phones.index', compact('phones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PhonesCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PhonesCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $phone = $this->repository->create($request->all());

            $response = [
                'message' => 'Phones created.',
                'data'    => $phone->toArray(),
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
        $phone = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $phone,
            ]);
        }

        return view('phones.show', compact('phone'));
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
        $phone = $this->repository->find($id);

        return view('phones.edit', compact('phone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PhonesUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PhonesUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $phone = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Phones updated.',
                'data'    => $phone->toArray(),
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
                'message' => 'Phones deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Phones deleted.');
    }
}
