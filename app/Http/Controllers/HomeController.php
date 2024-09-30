<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $posts = Post::when($request->query('search'),function (Builder $query) use($request){
            return $query->where('title','LIKE', '%' . $request->query('search'). '%')
                ->orWhere('body', 'LIKE', '%' . $request->query('search') . '%');
        })
            ->when($request->query('category'), function (Builder $query) use ($request) {

                return $query->whereRelation('category', 'slug', $request->query('category'));
            })
        ->latest()
         ->paginate(5);
        return view('blog.index',[
            'posts' => $posts,
            'categories' => Category::all(),
        ]);
    }
}
