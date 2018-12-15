<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleMessage;
use App\Events\ArticleCreating;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    private $rules = [
        'theme' => 'required|min:2|max:191',
        'user_id' => 'required',
        'deadline' => 'required|date',
        'price' => 'required|numeric',
        'message' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create', [
            'authors' => User::where('role', '=', User::AUTHOR_ROLE)->whereIsActive(1)->get()->pluck('fullname', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $article = new Article();
        $article->fill($request->all());
        $article->save();

        return redirect()->route('articles.show', $article->id)
            ->with('success', 'New article has been successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);

        if ($article->author_new_message) {
            $article->author_new_message = false;
            $article->save();
        }

        $isEnableEditing = $article->status == Article::ARTICLE_COMPLETED ? true : false;
        $isEnableConfirm = $article->status == Article::ARTICLE_COMPLETED ? true : false;
        $isEnableEdit = $article->status != Article::ARTICLE_CONFIRMED ? true : false;
        $deadline = !empty($article->revision_date) ? $article->revision_date : $article->deadline;

        $messages = ArticleMessage::whereArticleId($id)->orderBy('id', 'desc')->get();

        return view(
            'articles.show',
            compact('article', 'messages', 'isEnableEditing', 'isEnableConfirm', 'deadline', 'isEnableEdit')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);

        if ($article->status == Article::ARTICLE_CONFIRMED) {
            return redirect()->route('articles.index');
        }

        return view('articles.edit', [
            'article' => $article,
            'authors' => User::where('role', '=', User::AUTHOR_ROLE)->get()->pluck('fullname', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules);

        $article = Article::find($id);
        $article->fill($request->all());
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::find($id)->delete();

        return redirect()->route('articles.index')->with('success', 'Article has been deleted.');
    }

    /**
     * Download file from attached.
     *
     * @param  int  $id
     * @param  string  $file
     * @return \Illuminate\Http\Response
     */
    public function attached($id)
    {
        $article = Article::find($id);
        $pathToFile = public_path() . Article::PATH_TO_ATTACHES;

        if (Auth::user()->role == User::AUTHOR_ROLE && Auth::user()->id != $article->user_id) {
            abort(404);
        }

        return response()->download($pathToFile . $article->file_attache, $article->file_attache_name);
    }

    /**
 * Download file from attached.
 *
 * @param  int  $id
 * @param  string  $file
 * @return \Illuminate\Http\Response
 */
    public function download($id)
    {
        $article = Article::find($id);
        $pathToFile = public_path() . Article::PATH_TO_ARTICLES;

        if (Auth::user()->role == User::AUTHOR_ROLE && Auth::user()->id != $article->user_id) {
            abort(404);
        }

        return response()->download($pathToFile . $article->file_result, $article->file_result_name);
    }

    /**
     * Download file from attached.
     *
     * @param  int  $id
     * @param  string  $file
     * @return \Illuminate\Http\Response
     */
    public function edited($id)
    {
        $article = Article::find($id);
        $pathToFile = public_path() . Article::PATH_TO_ARTICLES;

        if (Auth::user()->role == User::AUTHOR_ROLE && Auth::user()->id != $article->user_id) {
            abort(404);
        }

        return response()->download($pathToFile . $article->file_revision, $article->file_revision_name);
    }

    /**
     * Display a listing of the resource for the author.
     *
     * @return \Illuminate\Http\Response
     */
    public function authorArticles()
    {
        $articles = Article::whereUserId(Auth::user()->id)->get();

        return view('articles.tasks', compact('articles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $this->validate($request, [
            'file_result' => 'required|file'
        ]);

        $article = Article::find($request->article_id);

        if (!$article || $article->user_id != Auth::user()->id) {
            abort(404);
        }

        $article->fill($request->all());
        $article->status = Article::ARTICLE_COMPLETED;
        $article->complete_date = Carbon::now();
        $article->save();

        return redirect('tasks')->with('success', 'The article was sent to the administrator for review.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function revision(Request $request)
    {
        $this->validate($request, [
            'file_revision' => 'required|file'
        ]);

        $article = Article::find($request->article_id);

        if (!$article || $article->user_id != Auth::user()->id) {
            abort(404);
        }

        $article->fill($request->all());
        $article->status = Article::ARTICLE_COMPLETED;
        $article->revision_complete_date = Carbon::now();
        $article->save();

        return redirect('tasks')->with('success', 'The article was sent to the administrator for review.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function authorView($id)
    {
        $article = Article::find($id);

        if (!$article || $article->user_id != Auth::user()->id) {
            abort(404);
        }

        if ($article->status == Article::ARTICLE_NEW) {
            $article->status = Article::ARTICLE_VIEWED;
            $article->save();
        }

        if ($article->admin_new_message) {
            $article->admin_new_message = false;
            $article->save();
        }

        $messages = ArticleMessage::whereArticleId($id)->orderBy('id', 'desc')->get();

        if ($article->status == Article::ARTICLE_CORRECTION || !empty($article->revision_date)) {
            $route = 'articles.revision';
            $fieldName = 'file_revision';
        } else {
            $route = 'articles.send';
            $fieldName = 'file_result';
        }

        $isSendAvailable = $article->status != Article::ARTICLE_CONFIRMED ? true : false;

        return view('articles.author-view', compact('article', 'messages', 'route', 'fieldName', 'isSendAvailable'));
    }

    public function sendMessage(Request $request)
    {
        $this->validate($request, [
            'message' => 'required|max:5000',
            'article_id' => 'required|numeric',
            'revision_date' => 'nullable|date'
        ]);

        $message = new ArticleMessage();
        $message->fill($request->all());
        $message->article_id = $request->get('article_id');
        $message->user_id = Auth::user()->id;
        $message->date = Carbon::now();
        $message->save();

        $article = Article::find($request->get('article_id'));

        if (Auth::user()->role == User::AUTHOR_ROLE) {
            $article->author_new_message = true;
        } else {
            $article->admin_new_message = true;
        }

        if (!empty($request->revision_date)) {
            $article->revision_date = $request->revision_date;
            $article->status = Article::ARTICLE_CORRECTION;
        }

        $article->save();

        return redirect()->back()->with('success', 'Your message has been sent.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirm($id)
    {
        $article = Article::find($id);
        $article->status = Article::ARTICLE_CONFIRMED;
        $article->save();

        return redirect()->route('articles.index')->with('success', 'The article has been successfully confirmed.');
    }
}
