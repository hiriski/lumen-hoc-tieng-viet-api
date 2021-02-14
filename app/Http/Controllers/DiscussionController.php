<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Discussion as DiscussionResource;
use App\Http\Resources\DiscussionCollection;

class DiscussionController extends Controller {

    protected static $itemPerPage = 20;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $discussions = Discussion::where('status_id', 3)
            ->orderBy('id', 'DESC')
            ->paginate(self::$itemPerPage);
        return new DiscussionCollection($discussions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'title'         => ['required', 'string', 'max:255'],
            'description'   => ['string'],
            'body'          => ['required', 'string'],
            'user_id'       => ['exists:users,id'],
            'topic_id'      => ['required', 'exists:topics,id'],
            'type_id'       => ['required', 'exists:discussion_types,id']
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $thread = $request->merge([
            'user_id' => Auth::user()->id
        ])->only(['title', 'description', 'body', 'user_id', 'topic_id', 'type_id']);

        try {
            return new DiscussionResource(Discussion::create($thread));
        } catch(\Exception $exception) {
            return response()->json([
                'message'   => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            $thread = Discussion::findOrFail($id);
            return new DiscussionResource($thread);
        } catch(\Exception $exception) {
            return response()->json([
                'message'  => $exception->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'title'         => ['string', 'max:255'],
            'description'   => ['string'],
            'body'          => ['string'],
            'topic_id'      => ['exists:topics,id']
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        $updatedDiscussion = $request->only([
            'title', 'description', 'body', 'topic_id'
        ]);

        try {
            $discussion = Discussion::findOrFail($id);
            $discussion->update($updatedDiscussion);
            return new DiscussionResource($discussion);
        } catch(\Exception $exception) {
            return response()->json([
                'message'  => $exception->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $discussion = Discussion::findOrFail($id);
            $discussion->delete();
            return new DiscussionResource($discussion);
        } catch(\Exception $exception) {
            return response()->json([
                'message'  => $exception->getMessage()
            ]);
        }
    }
}
