<?php
use Spatie\Newsletter\NewsletterFacade;
//use Newsletter;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/test',function(){
		return App\User::find(1)->profile;
	//	return App\Profile::find(1)->user;
		//return App\Tag::find(2)->posts;
		//return App\Category::find(4)->posts;

		//return App\Post::find(3)->tags;

		//dd(App\Category::find(4)->posts);
		//dd(App\Post::find(8)->category);
	});

//	Mail Subscription

	Route::post('/subscribe',function(){


		$email=request('email');
		Newsletter::subscribe($email);
		Session::flash('suscribed','Successfully Suscribed');

		return redirect()->back();
	});

	/*Route::post('/tests',[
		'uses'=>'TestController@index',
		'as'=>'test'
	]);*/

//	Mail Subscription End


	Route::get('/',[
		'uses'=>'FrontEndController@index',
		'as'=>'index'
	]);

	Route::get('/post/{slug}',[
		'uses'=>'FrontEndController@singlePost',
		'as'=>'post.single'
	]);
	Route::get('/category/{id}',[
		'uses'=>'FrontEndController@category',
		'as'=>'category.single'
	]);

	Route::get('/tag/{id}',[
		'uses'=>'FrontEndController@tag',
		'as'=>'tag.single'
	]);


	Route::get('/results',function(){
		$posts=\App\Post::where('title','like','%' . request('query') . '%')->get();
		$query=request('query');
		$title= 'Search Results'. request('query');
		$settings=\App\Setting::first();
		$categories=\App\Category::take(4)->get();
		$tags=\App\Tag::all();

		return view('results',compact('posts','title','settings','categories','query','tags'));
	});

	Auth::routes();



	Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){

		Route::get('/dashboard',
			[
				'uses'=>'HomeController@index',
				'as'=>'dashboard'
			]
		);
		//Posts
		Route::get('/posts',
			[
				'uses'=>'PostsController@Search',
				'as'=>'posts'
			]
		);
		//ajax
		Route::post('/posts',
			[
				'uses'=>'PostsController@search_post',
				'as'=>'posts'
			]
		);
		//endajax
		Route::get('/post/create',
			[
				'uses'=>'PostsController@create',
				'as'=>'post.create'
			]
		);

		Route::post('/post/store',
			[
			'uses'=>'PostsController@store',
			'as'=>'post.store'
			]
		);
		Route::get('/post/edit/{id}',
			[
			'uses'=>'PostsController@edit',
			'as'=>'post.edit'
			]
		);
		Route::post('/post/update/{id}',
			[
				'uses'=>'PostsController@update',
				'as'=>'post.update'
			]
		);
		Route::get('/post/trashed',[
			'uses'=>'PostsController@trashed',
			'as'=>'post.trashed'
		]);
		Route::get('/post/restore/{id}',[
			'uses'=>'PostsController@restore',
			'as'=>'post.restore'
		]);
		Route::get('/post/kill/{id}',[
			'uses'=>'PostsController@kill',
			'as'=>'post.kill'
		]);
		Route::get('/post/delete/{id}',
			[
				'uses'=>'PostsController@destroy',
				'as'=>'post.delete'
			]
		);

		//Category

		Route::get('/categories',
			[
				'uses'=>'CategoriesController@index',
				'as'=>'categories'
			]
		);

		Route::get('/category/create',
			[
				'uses'=>'CategoriesController@create',
				'as'=>'category.create'
			]
		);


		Route::post('category/post',
			[
				'uses'=>'CategoriesController@store',
				'as'=>'category.store'
			]
		);

		Route::get('category/edit/{id}',
			[
				'uses'=>'CategoriesController@edit',
				'as'=>'category.edit'
			]
		);

		Route::post('category/update/{id}',
			[
				'uses'=>'CategoriesController@update',
				'as'=>'category.update'
			]
		);

		Route::get('category/delete/{id}',
			[
				'uses'=>'CategoriesController@destroy',
				'as'=>'category.delete'
			]
		);

		//Tags
		Route::get('/tags',
			[
				'uses'=>'TagsController@index',
				'as'=>'tags'
			]);
		Route::get('tags/create',
			[
				'uses'=>'TagsController@create',
				'as'=>'tags.create'
			]);
		Route::post('tags/post',
			[
				'uses'=>'TagsController@store',
				'as'=>'tags.store'
			]
		);


		Route::get('tags/edit/{id}',
			[
				'uses'=>'TagsController@edit',
				'as'=>'tags.edit'
			]
		);

		Route::post('tags/update/{id}',
			[
				'uses'=>'TagsController@update',
				'as'=>'tags.update'
			]);
		Route::get('tags/delete/{id}',
				[
					'uses'=>'TagsController@destroy',
					'as'=>'tags.delete'
				]
		);


		//Users
		Route::get('/users',
			[
				'uses'=>'UsersController@index',
				'as'=>'users'
			]);

		Route::get('/users/create',
			[
				'uses'=>'UsersController@create',
				'as'=>'users.create'
			]);

		Route::post('/users/store',
		[
			'uses'=>'UsersController@store',
			'as'=>'users.store'
		]);

		Route::get('user/admin/{id}',
		[
			'uses'=>'UsersController@admin',
			'as'=>'user.admin'
		]);

		Route::get('user/not.admin/{id}',
		[
			'uses'=>'UsersController@not_admin',
			'as'=>'user.not.admin'
		]);
		Route::get('user/delete/{id}',
			[
				'uses'=>'UsersController@destroy',
				'as'=>'user.delete'
			]);


		Route::get('user/profile',[
			'uses'=>'ProfilesController@index',
			'as'=>'user.profile'
		]);
		Route::post('/user/profile/update',
		[
			'uses'=>'ProfilesController@update',
			'as'=>'user.profile.update'
		]);

		Route::get('settings',[
			'uses'=>'SettingsController@index',
			'as'=>'settings'
		]);
		Route::post('/settings/update',[
			'uses'=>'SettingsController@update',
			'as'=>'settings.update'
		]);
	});
