<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Url;

class UrlController extends Controller {
    
    public function index() {

        //return all url entries
        //for all users
        //in the real would I would probably paginate this
        return Url::all();
    }

    public function create(Request $request) {

        //maybe do some validation that the request contains a valid url

        //see if url already has been shortedned
        $existingUrl =  Url::where( 'url', $request->url )->first();

        if( $existingUrl ) {
            return response()->json([
                'status' => false,
                'msg' => 'Duplicate Entry',
            ]);
        }


        //If Url is new, create the shortened version
        $shortUrl = $this->shortenUrl( $request->url );

        $url = new Url;
        $url->user_id = Auth::id();
        $url->url = $request->url;
        $url->short_url = $shortUrl;
        $url->save();

        //return success
        return response()->json([
            'status' => true,
            'msg' => 'Successfully saved.',
            'item' => $url,
        ]);

    }

    private function shortenUrl( $url ) {

        //Using Bit.ly here
        //pass Auth token in the header
        //the 'long_url' is the url to shorten
        $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . env('bitly_token'),
                    ])
                    ->post('https://api-ssl.bitly.com/v4/shorten', [
                        'long_url' => $url,
                    ]);

        //return only the new shortened url
        return $response['link'];
    }
}
