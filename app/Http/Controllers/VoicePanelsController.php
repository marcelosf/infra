<?php

namespace Infra\Http\Controllers\Infra;

use Illuminate\Http\Request;

use Infra\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Infra\Http\Requests\VoicePanelCreateRequest;
use Infra\Http\Requests\VoicePanelUpdateRequest;
use Infra\Repositories\Infra\VoicePanelRepository;
use Infra\Validators\Infra\VoicePanelValidator;

/**
 * Class VoicePanelsController.
 *
 * @package namespace Infra\Http\Controllers\Infra;
 */
class VoicePanelsController extends Controller
{
    /**
     * @var VoicePanelRepository
     */
    protected $repository;

    /**
     * @var VoicePanelValidator
     */
    protected $validator;

    /**
     * VoicePanelsController constructor.
     *
     * @param VoicePanelRepository $repository
     * @param VoicePanelValidator $validator
     */
    public function __construct(VoicePanelRepository $repository, VoicePanelValidator $validator)
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
        $voicePanels = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $voicePanels,
            ]);
        }

        return view('voicePanels.index', compact('voicePanels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  VoicePanelCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(VoicePanelCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $voicePanel = $this->repository->create($request->all());

            $response = [
                'message' => 'VoicePanel created.',
                'data'    => $voicePanel->toArray(),
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
        $voicePanel = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $voicePanel,
            ]);
        }

        return view('voicePanels.show', compact('voicePanel'));
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
        $voicePanel = $this->repository->find($id);

        return view('voicePanels.edit', compact('voicePanel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  VoicePanelUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(VoicePanelUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $voicePanel = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'VoicePanel updated.',
                'data'    => $voicePanel->toArray(),
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
                'message' => 'VoicePanel deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'VoicePanel deleted.');
    }
}
