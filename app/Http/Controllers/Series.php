<?php
/*
 * Copyright © 2016 DOTCOM Offshore, All Rights Reserved
 *
 * [This is the page ID ]
 * $id: Apis.php
 * Created:        @wissamsabbagh    Apr 18, 2016 | 1:19:02 PM
 * Last Update:    @wissamsabbagh    Apr 18, 2016 | 1:19:02 PM
 */

namespace App\Http\Controllers;

/* here call the name spaces of the base  controlter
 *
 */

//use App\Http\Controllers\Controller;
/**
 * Use the custome APi library
 *
 * @return void
 */
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Providers\ApiRequest;

class Series extends Controller {
    public function index() {
//        $apiobj = new ApiRequest(['get_shows' => 0]);
//        $series_response = json_decode($apiobj->GetSeries());
//
//        $series = object_get($series_response, 'Seasons');
//        $categories = object_get($series_response, 'Categories');
//
//        return view('series', ['content' => $series,
//                'content_pagetitle' => 'مسلسلات',
//                'categories' => $categories]);
        return redirect()->to('relatedshows/30348/%D9%85%D8%B3%D9%84%D8%B3%D9%84%D8%A7%D8%AA');
    }

    public function CategorySeries(Request $request) {
        $catid = $request->segment(2);
        if($catid != $request->segment(2)) {
            return redirect()->to('/');
        }
        $apiob = new ApiRequest(['cat_id' => $catid]);
        $catseries = json_decode($apiob->GetCategoryShows());
        /*
          Get the seasons from $catseries object
         * @string shows is the object
         *  */

        $cat_series = object_get($catseries, 'shows');
        /* this varaibale to be sent to the view when empty results */
        if(sizeof($cat_series < 0)) {
            $defaultvalue = 'لا يوجد نتائج بحث';
        }

        return view('series', ['defaultvalue' => $defaultvalue,
                'categories' => $this->getCategories(),
                'content_pagetitle' => urldecode($request->segment(3)),
                'content' => $cat_series]
        );
    }

    private function getCategories() {
        $apiobj = new ApiRequest(['get_shows' => 0]);
        $series_response = json_decode($apiobj->GetSeries());

        $categories = object_get($series_response, 'Categories');
        return $categories;
    }

}