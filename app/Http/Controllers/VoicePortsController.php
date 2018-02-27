<?php

namespace Infra\Http\Controllers\Infra;

use Illuminate\Http\Request;

use Infra\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Infra\Http\Requests\VoicePortCreateRequest;
use Infra\Http\Requests\VoicePortUpdateRequest;
use Infra\Repositories\Infra\VoicePortRepository;
use Infra\Validators\Infra\VoicePortValidator;

/**
 * Class VoicePortsController.
 *
 * @package namespace Infra\Http\Controllers\Infra;
 */
class VoicePortsController extends Controller
{
    /**
     * @var VoicePortRepository
     */
    protected $repository;

    /**
     * @var VoicePortValidator
     */
    protected $validator;

    /**
     * VoicePortsController constructor.
     *
     * @param VoicePortRepository $repository
     * @param VoicePortValidator $validator
     */
    public function __construct(VoicePortRepository $repository, VoicePortValidator $validator)
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
        $voicePorts = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $voicePorts,
            ]);
        }

        return view('voicePorts.index', compact('voicePorts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  VoicePortCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(VoicePortCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $voicePort = $this->repository->create($request->all());

            $response = [
                'message' => 'VoicePort created.',
                'data'    => $voicePort->toArray(),
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
        $voicePort = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $voicePort,
            ]);
        }

        return view('voicePorts.show', compact('voicePort'));
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
        $voicePort = $this->repository->find($id);

        return view('voicePorts.edit', compact('voicePort'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  VoicePortUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(VoicePortUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $voicePort = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'VoicePort updated.',
                'data'    => $voicePort->toArray(),
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
                'message' => 'VoicePort deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'VoicePort deleted.');
    }
}
