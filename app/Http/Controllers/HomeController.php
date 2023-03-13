<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $authors = [];
        $url = "https://symfony-skeleton.q-tests.com/api/v2/token";
        
        $client = new Client();

        $response = $client->post($url, [
            RequestOptions::JSON => ['email' => 'ahsoka.tano@q.agency', 'password' => 'Kryze4President']
        ]);
        $responseJSON = json_decode($response->getBody(), true);
        if($responseJSON['token_key']){
            session()->put('token_key',$responseJSON['token_key']);

            $response = Http::withToken($responseJSON['token_key'])->get('https://symfony-skeleton.q-tests.com/api/v2/authors?orderBy=id&direction=ASC&limit=12&page=1');
            $responseAuthor = json_decode($response->getBody(), true);
            if($responseAuthor['items']){
                $authors = $responseAuthor['items'] ; 
            }
        }
       
        return view('home',compact('authors'));
    }
    public function showAuthor($id)
    {   
        $response = Http::withToken(session()->get('token_key'))->get('https://symfony-skeleton.q-tests.com/api/v2/authors/'.$id);
        $author = json_decode($response->getBody(), true);
       
        return view('author.show',compact('author'));
    }
    public function deleteBook($id)
    {   
        $response = Http::withToken(session()->get('token_key'))->delete('https://symfony-skeleton.q-tests.com/api/v2/books/'.$id);
        return redirect()->back()->withSuccess('Book Delete Successfully!');
    }
    public function deleteAuthor($id)
    {   
        $response = Http::withToken(session()->get('token_key'))->delete('https://symfony-skeleton.q-tests.com/api/v2/authors/'.$id);
        return redirect()->back()->withSuccess('Author Delete Successfully!');
    }
    public function addBook()
    {   
        $authors = [];
        $url = "https://symfony-skeleton.q-tests.com/api/v2/token";
        $response = Http::withToken(session()->get('token_key'))->get('https://symfony-skeleton.q-tests.com/api/v2/authors?orderBy=id&direction=ASC&limit=12&page=1');
        $responseAuthor = json_decode($response->getBody(), true);
        if($responseAuthor['items']){
            $authors = $responseAuthor['items'] ; 
        }
        return view('book.add',compact('authors'));
        
    }
    public function storeBook(Request $request){
        $url = "https://symfony-skeleton.q-tests.com/api/v2/books";
        
        $response = Http::withToken(session()->get('token_key'))->post($url, [
            "author"=> array(
                "id"=> $request->select_author
            ),
            "title"=> $request->title,
            "release_date"=> date('Y-m-d H:i:s'),
            "description"=> $request->description,
            "isbn"=> "string",
            "format"=> "string",
            "number_of_pages"=> (int)$request->number_of_pages
        ]);
        
        
        $responseJSON = json_decode($response->getBody(), true);
        if($responseJSON['id']){
            return redirect('home')->withSuccess('Book Added  Successfully!');
        }else{
            return redirect('home')->withError('Something went wrong!');
        }
        
    }
    
    
}
