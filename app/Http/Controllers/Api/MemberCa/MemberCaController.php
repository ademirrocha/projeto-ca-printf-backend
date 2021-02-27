<?php

namespace App\Http\Controllers\Api\MemberCa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\MemberCa\UpdateRequest;
use App\Services\MemberCa\MemberService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\Api\MemberCa\MemberResource;

class MemberCaController extends Controller
{
    private $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function index(): AnonymousResourceCollection
    {

        $members = $this->memberService->all();

        return MemberResource::collection($members);
    }

    public function update(UpdateRequest $request)
    {

        $members = $this->memberService->update($request->only('president', 'vice_president', 'secretary', 'treasurer', 'communication_coordinator', 'events_coordinator'));

        return MemberResource::collection($members);

    }
}
