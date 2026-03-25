<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
	//
	public function index(){
		$todo = new Todo();
		$todos = $todo->all();
		return view('todo.index',['todos' => $todos]);
	}

	public function create(){
		return view('todo.create');
	}

	public function store(Request $request){
		$inputs = $request->all();
		$todo = new Todo();
		$todo->fill($inputs);
		$todo->save();

		return redirect()->route('todo.index');
	}

	public function show($id){
		$model = new Todo();
		// findメソッド
		// 基本的に主キーとして設定されているidでDBを検索する
		// SQL構文としてselect * from テーブル where id = 引数;
		// 上記を実行している
		// そのためcontentにidと一致するカラムがあっても無視される
		// contentで条件をつけて検索する際にはwhere()を使用
		$todo = $model->find($id);

		return view('todo.show',['todo'=>$todo]);
	}
}
