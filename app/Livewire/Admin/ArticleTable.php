<?php

namespace App\Livewire\Admin;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleTable extends Component
{
    use WithPagination; 

    public function render()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.article-table');

    }
}
