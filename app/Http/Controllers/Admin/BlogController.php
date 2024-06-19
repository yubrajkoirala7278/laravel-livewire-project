<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Service\BlogService;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    private $blogService;

    public function __construct()
    {
        $this->blogService = new BlogService();
    }

    public function home()
    {
        return view('admin.blogs.index');
    }


    public function index()
    {
        try {
            $blogs = $this->blogService->fetchBlogs();
            return DataTables::of($blogs)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $viewUrl = route('blogs.view', ['slug' => $row->slug]);
                    return '<a href="javascript:void(0)" class="btn btn-info editButton" data-slug="' . $row->slug . '">Edit</a> 
                    <a href="javascript:void(0)" class="btn btn-danger delButton" data-slug="' . $row->slug . '">Delete</a> 
                    <a href="' . $viewUrl . '" class="btn btn-success">View</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function store(BlogRequest $request)
    {
        try {
            $this->blogService->addService($request->validated());
            return response()->json([
                'success' => 'Blog added successfully'
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
            // return response()->json(['error' =>'Something went wrong'],500);
        }
    }

    public function edit($slug)
    {
        try {
            $blog = $this->blogService->fetchSingleBlog($slug);
            if (!$blog) {
                abort(404);
            }
            return $blog;
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function update(BlogRequest $request)
    {
        try {
            $blog = Blog::where('slug', $request->blog_slug)->first();
            if (!$blog) {
                abort(404);
            }
            $this->blogService->updateBlog($request->validated(), $blog);
            return response()->json([
                'success' => 'Blog Updated Successfully'
            ], 201);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($slug)
    {
        try{
            $blog = Blog::where('slug', $slug)->first();
            if (!$blog) {
                abort(404);
            }
            $this->blogService->delete($blog);
            return response()->json([
                'success' => 'Blog Deleted Successfully'
            ], 201);
        }catch(\Throwable $th){
            return back()->with('error',$th->getMessage());
        }
    }

    public function view($slug)
    {
        try {
            $blog = $this->blogService->fetchSingleBlog($slug);
            if (!$blog) {
                abort(404);
            }
            return view('admin.blogs.view', compact('blog'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
