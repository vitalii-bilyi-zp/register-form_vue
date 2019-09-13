<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Http\Requests\StoreMember;
use App\Http\Requests\UpdateMember;
use App\Services\MemberService;
use App\Services\FileService;
use Illuminate\Pagination\LengthAwarePaginator;

class MembersController extends Controller
{
    /**
     * @var MemberService
     */
    protected $memberService;

    /**
     * @var FileService
     */
    protected $fileService;

    /**
     * Create a new controller instance.
     *
     * @param MemberService $memberService
     */
    public function __construct(MemberService $memberService, FileService $fileService)
    {
        $this->memberService = $memberService;
        $this->fileService = $fileService;
    }

    /**
     * Store or update the incoming member if such is already exist.
     *
     * @param StoreMember $request
     *
     * @return Response
     */
    public function store(StoreMember $request)
    {
        $postData = $request->post();
        $member = $this->memberService->insert($postData);

        if (isset($member->id)) {
            return response()->json(['operationStatus' => 'inserted', 'memberId' => $member->id], 200);
        }

        return response()->json(['operationStatus' => 'failed'], 500);
    }

    public function update(UpdateMember $request, $id)
    {
        $postData = $request->post();
        $photo = $request->file('photo');

        if (!is_null($photo)) {
            $imagePath = $this->fileService->storeUploadedImage($photo, Member::IMAGES_FOLDER, 'images');

            if ($imagePath) {
                $postData['original_file_name'] = $photo->getClientOriginalName();
                $postData['hash_file_name'] = basename($imagePath);
            }
        }

        if ($this->memberService->update($postData, $id)) {
            return response()->json(['operationStatus' => 'updated'], 200);
        }

        return response()->json(['operationStatus' => 'failed'], 500);
    }

    public function index()
    {
        $membersPaginated = Member::orderBy('created_at', 'desc')
            ->paginate(5, ['id', 'firstname', 'lastname', 'report', 'email', 'hash_file_name']);

        $membersTransformed = $membersPaginated->getCollection()
            ->transform(function($member) {
                if (isset($member['hash_file_name'])) {
                    $member['photo'] = asset('storage/images/'.Member::IMAGES_FOLDER.'/'.$member['hash_file_name']);
                }
                return $member;
            })
            ->toArray();

        $members = new LengthAwarePaginator(
            $membersTransformed,
            $membersPaginated->total(),
            $membersPaginated->perPage(),
            $membersPaginated->currentPage(), [
                'path' => \Request::url(),
                'query' => [
                    'page' => $membersPaginated->currentPage()
                ]
            ]
        );

        return response()->json($members);
    }

    public function getById($id)
    {
        $member = Member::findOrFail($id, ['firstname', 'lastname', 'birthdate', 'report', 'country_id', 'phone', 'email', 'company', 'position', 'about']);

        return response()->json($member);
    }
}
