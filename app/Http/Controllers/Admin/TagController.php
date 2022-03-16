<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use App\Contracts\Services\TagContract;

class TagController extends Controller
{
    private $tagService;

    public function __construct(TagContract $tagService)
    {
        $this->tagService = $tagService;

    }
    public function getAllTags()
    {
        return response()->json($this->tagService->getAllTags(), $this->tagService->getAllTags()['status']);
    }

    public function createTag(Request $request)
    {
        return response()->json($this->tagService->createTag($request), $this->tagService->createTag($request)['status']);
    }


    public function deleteTag($id)
    {

        return response()->json($this->tagService->deleteTag( (int) $id), $this->tagService->deleteTag( (int) $id)['status']);

    }



}
