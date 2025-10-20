<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $members = Member::all();
        $members = Member::with('activeBorrowings');
        // return response()->json([
        //     'status' => "true",
        //     'message'=> "Members retrieved successfully",
        //     'data' => $members
        // ]);
        if($request->has('search')){
            $search  = $request->input('search');
            $members = $members->where('name','like',"%$search%")
                        ->orWhere('email','like',"%$search%");
        }
       if($request->has('status')){
            $status = $request->input('status');
            $members = $members->where('status',$status);
       }
       $members = $members->paginate(10);
       return MemberResource::collection($members);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $member = Member::create($request->validated());
        return new MemberResource($member);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $member = Member::findOrFail($id);
        $member = Member::with(['activeBorrowings', 'borrowings'])->findOrFail($id);
        return new MemberResource($member);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $member->update($request->validated());
        $member->load('activeBorrowings', 'borrowings');
        return new MemberResource($member);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        // $member = Member::findOrFail($id);
        // $member->delete();
        // return response()->json([
        //     'status' => true,
        //     'message'=> "Member deleted successfully",
        // ]);

        if($member->activeBorrowings->count() > 0){
            return response()->json([
                'status' => false,
                'message'=> "Member has active borrowings, cannot be deleted",
            ],422);
        }

        $member->delete();
        return response()->json([
            'status' => true,
            'message'=> "Member deleted successfully",
        ]);
    }
}
