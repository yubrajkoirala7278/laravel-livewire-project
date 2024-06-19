<?php

namespace App\Service;

use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogService
{

    // =============POST============
    public function addService($request)
    {
        // store single image in local storage folder
        if (isset($request['image'])) {
            $timestamp = now()->timestamp;
            $originalName = $request['image']->getClientOriginalName();
            $imageName = $timestamp . '-' . $originalName;
            $request['image']->storeAs('public/images/blogs', $imageName);

            // update the image name in the $request array
            $request['image'] = $imageName;
        };

        // store in database table
        Blog::create($request);
    }


    // ==========FETCH(ALL BLOGS)=================
    public function fetchBlogs()
    {
        $blogs = Blog::latest();
        return $blogs;
    }

    // ========Single Blog(FETCH)================
    public function fetchSingleBlog($slug){
        $blog=Blog::where('slug',$slug)->first();
        return $blog;
    }

    // =========UPDATE Blog===================
    public function updateBlog($request,$blog){
          // Check if a new image is uploaded
          if (isset($request['image'])) {
            // Delete the old image from storage folder
            Storage::delete('public/images/blogs/' . $blog->image);
            // Store the new image
            $timestamp = now()->timestamp;
            $originalName = $request['image']->getClientOriginalName();
            $imageName = $timestamp . '-' . $originalName;
            $request['image']->storeAs('public/images/blogs', $imageName);
            // Update the image name in the $request array
            $request['image'] = $imageName;
        } else {
            $request['image'] = $blog->image;
        }
        // Update in db
        $blog->update($request);
    }

     // =========DELETE==========
     public function delete($blog){
        // delete image from local storage
        if(isset($blog->image)){
            Storage::delete('public/images/blogs/'.$blog->image);
        }
        // delete from db
        $blog->delete();
    }
}