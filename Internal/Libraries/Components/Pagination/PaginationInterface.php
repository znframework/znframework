<?php
namespace ZN\Components;

interface PaginationInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	public function url($url);
	
	public function start($start);
	
	public function limit($limit);
	
	public function type($type);
	
	public function totalRows($totalRows);
	
	public function countLinks($countLinks);
	
	public function linkNames($prev, $next, $first, $last);
	
	public function css($css);
	
	public function style($style);

	public function settings($config);
	
	public function create($start, $settings);
}