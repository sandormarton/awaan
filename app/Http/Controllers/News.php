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

use App\Http\Controllers\Controller;
use App\Providers\ApiRequest;
use Carbon\Carbon;
/**
 * Use the custome APi library
 *
 * @return void
 */
use Illuminate\Http\Request;

class News extends Controller {
    private $categories = [];

    public function __construct() {
        $this->categories = [ 6904 => 'تقارير إخبارية',
                8633 => 'مدارات',
                8485 => '  News reports'
        ];
    }

    public function index() {
        $apiobj = new ApiRequest();
        $news_details = ($apiobj->GetNews('awaannews'));
        $news_featured = ($apiobj->GetNews('news_featured'));
        $news_mostviewed = ($apiobj->GetNews('news_mostviewed'));
        $currentnews = current($news_details);
        /* using carbon api from laravel to parse the Date time in a specific format
          // */
        // $currentnews->news_date = Carbon::parse($currentnews->recorder_date)->format('D-M-m-Y');

        if(sizeof($news_details > 0)) {
            $news_details_rows = '';
            foreach($news_details as $id => $news) {
                $news->news_date = Carbon::parse($news->recorder_date)->format('d-m-Y');

                $news_details_rows .= view('news.newsdetails', compact('news'))->render();
            }
        }

        if(sizeof($news_featured > 0)) {
            $news_featured_rows = '';
            foreach($news_featured as $news) {
                $news->news_date = Carbon::parse($news->recorder_date)->format('d-m-Y');
                $news_featured_rows .= view('news.news_latestnews', compact('news'))->render();
            }
        }

        /* Define array for the header categories */
        $categories = $this->categories;

        return view('news.news', compact('currentnews', 'categories', 'news_details_rows', 'news_featured_rows', 'news_most_rows', 'news_mostviewed')
                )->render();
    }

    public function GetVideos(Request $request) {
        $vid = $request->segment(3);
        $apiobj = new ApiRequest(['video_id' => $vid]);
        $this->video_response = json_decode($apiobj->GetVideo());

        if(is_object($this->video_response) && isset($this->video_response->video)) {
            $videocontent = object_get($this->video_response, 'video');
        }
        $featuredshows = object_get($this->video_response, 'featuredshows');
        //store the current season to display it in the selected
        $shows_seasons = object_get($this->video_response, 'ShowSeasons');

//        $current = $videocontent = $featuredshows = $featuredshows = '';
        if(sizeof($shows_seasons) > 0) {
            $current = $shows_seasons[0];
            unset($shows_seasons[0]);
        }
        /* remove the selected to avoid duplications */


        /* generate base url */
        $shareurl = url('/').'/video/'.($videocontent->title_ar).'/'.$videocontent->id;
        $shortenurl = $apiobj->ShortenURL($shareurl);
        $categories = $this->categories;
        $video_signature = $this->parseVideoUrl($videocontent->embed)['signature'][0];

        return view('news.news_videos', ['currentseasons' => $current,
                'otherseasons' => $shows_seasons,
                'featuredshows' => $featuredshows,
                'content' => $videocontent,
                'shareurl' => $shortenurl,
                'categories' => $categories,
                'videosignature' => $video_signature,
                'vid' => $vid
                // 'categories' => $this->video_response->Categories
                ]
        );
    }

    private function parseVideoUrl($code = '') {
        /* Get query portion from url */
        if(!empty($code)) {
            $video_embedd = parse_url($code, PHP_URL_QUERY);

            $querystring_portion = explode('&', $video_embedd);
            foreach($querystring_portion as $param) {
                list($name, $value) = explode('=', $param);
                $params[urldecode($name)][] = urldecode($value);
            }
            return $params;
        }
    }

    /* Call the  Request object as  closure */
    public function getSeasonsVideos(Request $request) {
        if($request->ajax()) {
            $season_id = $request->input('seasonid');
            $api = new ApiRequest(array('season_id' => $season_id));
            $season_videos = json_decode($api->getVideosSeasons(), true);


            $html = view('news.news_seasons_videos', compact('season_videos'))->render();
            echo $html;
        }
    }

    public function GetRelatedNews(Request $request,$catid) {
        $page = $request -> input("page");
        if(empty($page)) $page = 1;

        $api = new ApiRequest(array('cat_id' => $catid));
        $result = $api->GetNewsByCategory(20,$page);
        //dd($result);
        $show_details = json_decode($api->getShowDetails());
        /* call the api with static category id of the newsreport */
        $news_reportapiobj = new ApiRequest(array('cat_id' => 199091));
        $news_report_showdetails = json_decode($news_reportapiobj->getShowDetails());
        $categ_result = object_get($result, 'results');
        if(sizeof($categ_result) > 0) {
            $current = current($categ_result);
        }
        $categories = $this->categories;
        $category_pagetitle['page_title_ar'] = $categories[$catid];
        /**/

        $otherseasons = [];
        return view('news.news_categ_videos', ['content' => $categ_result,
                'current' => $current,
                'categories' => $categories,
                'category_pagetitle' => $category_pagetitle,
                'otherseasons' => $news_report_showdetails->ShowSeasons,
                'featuredshows' => $show_details->featuredshows
        ]);
    }

    public function More($type) {
        $apiobj = new ApiRequest();

        if($type == 'latest') {
            $all_content = ($apiobj->GetNews('news_featured', 200));
            $other_content = ['route' => 'news/videos',
                    'page_title_ar' => trans('content.news.latestnews'),
                    'class' => 'all-vod-latest-show-more-wrapper'
            ];
        }
        elseif($type == 'most') {
            $all_content = ($apiobj->GetNews('news_mostviewed', 200));
            $other_content = ['route' => 'news/videos',
                    'page_title_ar' => trans('content.allshows.mostviewed'),
                    'class' => 'all-vod-latest-show-more-wrapper'
            ];
        }

        return view('all_vod', ['other_content' => $other_content, 'content' => $all_content, 'categories' => array()]);
    }

    public function modal() {
        return view('modaltest');
    }

}