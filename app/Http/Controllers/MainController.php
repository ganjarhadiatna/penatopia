<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\StoryModel;
use App\ProfileModel;
use App\TagModel;
use App\FollowModel;
use App\BookmarkModel;

class MainController extends Controller
{
    function index()
    {
        $topStory = StoryModel::PagAllStory(16);
        return view('others.index', [
            'title' => 'Home',
            'path' => 'home',
            'topStory' => $topStory
        ]);
    }
    function collections()
    {
        if (Auth::id()) {
            $id = Auth::id();   
        } else {
            $id = 0;
        }
        $topStory = StoryModel::PagAllStory(16);
        $topTags = TagModel::TopTags(8);
        $allTags = TagModel::AllTags();
    	return view('collections.index', [
            'title' => 'Collections',
            'path' => 'collections',
            'topStory' => $topStory,
            'topTags' => $topTags,
            'allTags' => $allTags
        ]);
    }
    function collectionsId($ctr)
    {
    	return view('others.index', ['title' => 'Collections', 'path' => 'collections']);
    }
    function tagsId($ctr)
    {
        $topStory = StoryModel::PagTagStory($ctr, 12);
        return view('others.index', [
            'title' => 'Tags '.$ctr,
            'path' => 'none',
            'topStory' => $topStory
        ]);
    }
    function popular()
    {
        $topStory = StoryModel::PagPopularStory(16);
    	return view('others.index', [
            'title' => 'Popular',
            'path' => 'popular',
            'topStory' => $topStory
        ]);
    }
    function compose()
    {
        return view('compose.index', ['title' => 'New Story', 'path' => 'compose']);
    }
    function fresh()
    {
        $topStory = StoryModel::PagAllStory(16);
        return view('others.index', [
            'title' => 'Fresh',
            'path' => 'fresh',
            'topStory' => $topStory
        ]);
    }
    function trending()
    {
        $topStory = StoryModel::PagTrendingStory(16);
        return view('others.index', [
            'title' => 'Trending',
            'path' => 'trending',
            'topStory' => $topStory
        ]);
    }
    function search($ctr)
    {
        if (Auth::id()) {
            $id = Auth::id();   
        } else {
            $id = 0;
        }
        $topStory = StoryModel::PagSearchStory($ctr, 16);
        $topUsers = ProfileModel::SearchUsers($ctr, $id);
        $topTags = TagModel::SearchTags($ctr);
        return view('search.index', [
            'title' => $ctr,
            'path' => 'home-search',
            'topStory' => $topStory,
            'topUsers' => $topUsers,
            'topTags' => $topTags
        ]);
    }

    function ranking()
    {
        return $this->rankingStory();
    }
    function rankingUser()
    {
        if (Auth::id()) {
            $id = Auth::id();   
        } else {
            $id = 0;
        }
        $topProfile = ProfileModel::TopUsers($id, 20);
        return view('ranking.user', [
            'title' => 'Ranking',
            'path' => 'ranking',
            'path_r' => 'user',
            'profile' => $topProfile
        ]);
    }
    function rankingStory()
    {
        $topStory = StoryModel::PagTrendingStory(16);
        return view('ranking.story', [
            'title' => 'Ranking',
            'path' => 'ranking',
            'path_r' => 'story',
            'topStory' => $topStory
        ]);
    }
    function rankingCtr()
    {
        $allTags = TagModel::TopTags(50);
        return view('ranking.category', [
            'title' => 'Ranking',
            'path' => 'ranking',
            'path_r' => 'ctr',
            'allTags' => $allTags
        ]);
    }

    function login()
    {
        return view('sign.in', ['title' => 'Login', 'path' => 'none']);
    }
    function signup()
    {
        return view('sign.up', ['title' => 'Signup', 'path' => 'none']);
    }
}
