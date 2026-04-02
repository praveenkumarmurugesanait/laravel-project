<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function create()
    {
        $posts = Post::paginate(5);
        return view('form', compact('posts'));
    }

    public function posts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'email' => 'required|email',
            'phone_number' => ['required', 'digits:10'],
            'address' => 'required|string|max:255',
            'city' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'state' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'country' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'zipcode' => ['required', 'digits_between:4,10'],
            'role' => 'required|integer',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date|before:today',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        Post::create($request->all());

        return response()->json([
            'message' => 'Data saved successfully!'
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'email' => 'required|email',
            'phone_number' => ['required', 'digits:10'],
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'zipcode' => 'required',
            'role' => 'required|integer',
            'gender' => 'required',
            'dob' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return response()->json([
            'message' => 'Data updated successfully!'
        ]);
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json([
            'message' => 'Data deleted successfully!'
        ]);
    }
}