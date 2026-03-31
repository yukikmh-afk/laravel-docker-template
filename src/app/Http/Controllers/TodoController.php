<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
	// 型指定なし
	// ジャグリング(型をphpが状況に合わせて勝手に決める)
	private $todo;

	public function __construct(Todo $todo){
		$this->todo = $todo;
	}
	
	public function index(){
		$todos = $this->todo->all();
		return view('todo.index',['todos' => $todos]);
	}

	public function create(){
		return view('todo.create');
	}

	public function store(Request $request){
		$inputs = $reques->all();
		$this->todo->fill($inputs);
		$this->todo->save();

		return redirect()->route('todo.index');
	}

	public function show($id){
		// findメソッド
		// 基本的に主キーとして設定されているidでDBを検索する
		// SQL構文としてselect * from テーブル where id = 引数;
		// 上記を実行している
		// そのためcontentにidと一致するカラムがあっても無視される
		// contentで条件をつけて検索する際にはwhere()を使用
		$todo = $this->todo->find($id);

		return view('todo.show',['todo'=>$todo]);
	}

	public function edit($id){
		$todo = $this->todo->find($id);
		return view('todo.edit',['todo'=>$todo]);
	}

	public function update(Request $request, $id){
		$input = $request['content'];
		$todo = $this->todo->find($id);
		$todo->fill(['content'=>$input])->save();

		return redirect()->route('todo.show',$todo->id);
	}
}
