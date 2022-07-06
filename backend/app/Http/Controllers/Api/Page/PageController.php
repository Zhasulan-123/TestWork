<?php

namespace App\Http\Controllers\Api\Page;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

use Validator;

class PageController extends Controller
{
    public function page() {
        return response()->json(Page::get(), 200);
    }

    public function pageById($id) {
        $page = Page::find($id);
        if ( is_null($page) ) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        return response()->json($page, 200);
    }

    public function pageSave(Request $req) {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'text' => 'required'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $page = Page::create($req->all());
        return response()->json($page, 201);
    }

    public function pageEdit(Request $req, $id) {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'text' => 'required'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $page = Page::find($id);
        if ( is_null($page) ) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $page->update($req->all());
        return response()->json($page, 200);
    }

    public function pageDelete(Request $req, $id) {
        $page = Page::find($id);
        if ( is_null($page) ) {
            return response()->json(['error' => true, 'message' => 'Not found'], 404);
        }
        $page->delete();
        return response()->json('', 204);
    }
}