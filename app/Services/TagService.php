<?php

namespace App\Services;

use App\Contracts\Services\TagContract;
use App\Contracts\Repositories\TagRepository;
use App\Helpers\UtilityHelper;
use Validator;

class TagService implements TagContract
{
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getAllTags()
    {
        try{
            return UtilityHelper::RETURN_SUCCESS_FORMAT(
                200,
                'All Tags Successfully Fetched!',
                $this->tagRepository->getAllTags()
            );
        }catch (Exception $exception){
            return UtilityHelper::RETURN_ERROR_FORMAT(
                500
            );
        }
    }

    public function createTag($request){
        try{
            $rules = [
                'tag_value' => 'required|unique:tags',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }
            $tag = [
                'user_id' => '1',
                'tag_value' => $request->tag_value
            ];
            return UtilityHelper::RETURN_SUCCESS_FORMAT(
                200,
                'A Tag Successfully Created!',
                $this->tagRepository->createTag($tag)
            );
        }catch (Exception $exception){
            return UtilityHelper::RETURN_ERROR_FORMAT(
                500
            );
        }
    }

    public function deleteTag($id){
        try{
            return UtilityHelper::RETURN_SUCCESS_FORMAT(
                200,
                'A Tag Successfully Deleted!',
                $this->tagRepository->deleteTag($id)
            );
        }catch (Exception $exception){
            return UtilityHelper::RETURN_ERROR_FORMAT(
                500
            );
        }
    }
}
