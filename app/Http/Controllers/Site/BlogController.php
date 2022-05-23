<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Contracts\BlogContract;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Controllers\BaseController;
use Auth;

class BlogController extends BaseController
{
	/**
     * @var BlogContract
     */
    protected $blogRepository;


    /**
     * PageController constructor.
     * @param BlogContract $blogRepository
     */
    public function __construct(BlogContract $blogRepository){
        $this->blogRepository = $blogRepository;
    }

    public function index(){
    	$blogs = $this->blogRepository->getBlogs();
        $latestBlogs = $this->blogRepository->latestBlogs();
        $categories = $this->blogRepository->getBlogcategories();
        $tags = $this->blogRepository->getBlogtags();

    	$this->setPageTitle('Blog List', 'List of blogs');
        return view('site.blog.index', compact('blogs','latestBlogs','categories','tags'));
    }

    /**
     * @param $id
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($id,$slug)
    {
        $blogs = $this->blogRepository->detailsBlog($id);
        $blog = $blogs[0];

        $relatedBlogs = $this->blogRepository->getRelatedBlogs($blog->category_id, $blog->id);

        $latestBlogs = $this->blogRepository->latestBlogs();
        $categories = $this->blogRepository->getBlogcategories();

        $this->setPageTitle($blog->title, 'Blog Details : '.$blog->title);
        return view('site.blog.details', compact('blog','relatedBlogs','latestBlogs','categories'));
    }

    /**
     * @param $id
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categoryWiseList($id,$slug){
        $blogs = $this->blogRepository->categoryWiseBlogs($id);

        $latestBlogs = $this->blogRepository->latestBlogs();
        $categories = $this->blogRepository->getBlogcategories();

        $this->setPageTitle('Category Wise Blogs', 'Category wise list of blogs');
        return view('site.blog.category_wise', compact('blogs','latestBlogs','categories'));
    }


    /**
     * List all the states
     */
    public function post(Request $request)
    {
        $data =  Blog::paginate(5);
        if (!empty($request->term)) {
            // dd($request->term);
             $blogs = $this->blogRepository->getSearchBlog($request->term);

            // dd($categories);
         } else {
        $blogs = $this->blogRepository->listBlogs();
    }
        $this->setPageTitle('Blog', 'List of all Blog');
        return view('site.post.index', compact('blogs','data'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postcreate()
    {
        $this->setPageTitle('Blog', 'Create Blog');
        $blogcat = $this->blogRepository->getBlogcategories();
        $blogsubcat = $this->blogRepository->getBlogsubcategories();
       // $suburb = $this->blogRepository->getSuburb();
        $pin = $this->blogRepository->getPincode();

        return view('site.post.create',compact('blogcat','blogsubcat','pin'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function poststore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:1',
            'blog_category_id' => 'required|integer|min:1',
            'pincode' => 'required|integer|min:1',
            'suburb_id' => 'required|integer|min:1',
            'content' => 'required|string|min:1',
            'meta_title' => 'required|string',
            'meta_key' => 'required|string',
            'meta_description' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png|max:10000000',
            'banner_image' => 'required|mimes:jpg,jpeg,png|max:10000000',
            'image2' => 'required|mimes:jpg,jpeg,png|max:10000000',
        ]);

        $blog = $this->blogRepository->createBlog($request->except('_token'));

        if (!$blog) {
            return $this->responseRedirectBack('Error occurred while creating Blog.', 'error', true, true);
        }
        return $this->responseRedirect('site.localloop.post', 'Blog has been created successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postedit($id)
    {
        $targetblog = $this->blogRepository->findBlogById($id);
        $blogcat = $this->blogRepository->getBlogcategories();
        $blogsubcat = $this->blogRepository->getBlogsubcategories();
      //  $suburb = $this->blogRepository->getSuburb();
        $pin = $this->blogRepository->getPincode();
        $this->setPageTitle('Blog', 'Edit Blog : '.$targetblog->title);
        return view('site.post.edit', compact('targetblog','blogcat','blogsubcat','pin'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postupdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:1',
            'blog_category_id' => 'required|integer|min:1',
            'blog_sub_category_id' => 'required|integer|min:1',
            'pincode' => 'required|integer|min:1',
            'suburb_id' => 'required|integer|min:1',
            'content' => 'required|string|min:1',
            'meta_title' => 'required|string',
            'meta_key' => 'required|string',
            'meta_description' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png|max:10000000',
            'banner_image' => 'required|mimes:jpg,jpeg,png|max:10000000',
            'image2' => 'required|mimes:jpg,jpeg,png|max:10000000',
        ]);
        // $slug = Str::slug($request->name, '-');
        // $slugExistCount = Blog::where('slug', $slug)->count();
        // if ($slugExistCount > 0) $slug = $slug.'-'.($slugExistCount+1);
        $params = $request->except('_token');

        $targetblog = $this->blogRepository->updateBlog($params);

        if (!$targetblog) {
            return $this->responseRedirectBack('Error occurred while updating blog.', 'error', true, true);
        }
        return $this->responseRedirectBack('Blog has been updated successfully' ,'success',false, false);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postdelete($id)
    {
        $targetblog = $this->blogRepository->deleteBlog($id);

        if (!$targetblog) {
            return $this->responseRedirectBack('Error occurred while deleting Blog.', 'error', true, true);
        }
        return $this->responseRedirect('site.localloop.post', 'Blog has been deleted successfully' ,'success',false, false);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postupdateStatus(Request $request){

        $params = $request->except('_token');

        $targetblog = $this->blogRepository->updateBlogStatus($params);

        if ($targetblog) {
            return response()->json(array('message'=>'Blog status has been successfully updated'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postdetails($id)
    {
        $targetblog = $this->blogRepository->detailsBlog($id);
        $blog = $targetblog[0];

        $this->setPageTitle('Blog', 'Blog Details : '.$blog->title);
        return view('site.post.details', compact('blog'));
    }


}
