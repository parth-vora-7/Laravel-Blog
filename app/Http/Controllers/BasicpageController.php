<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BasicpageController extends Controller
{
    public function getServices()
    {
    	return view('pages.services');
    }

	public function getPortfolio()
    {
    	return view('pages.portfolio');
    }

    public function getAbout()
    {
    	return view('pages.about');
    }

    public function getTeam()
    {
    	return view('pages.team');
    }

    public function getContact()
    {
    	return view('pages.contact');
    }    
}
