<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $prefs["template"] = array(
			'table_open'				=> '<table class="calendar">',
			'heading_row_start'			=> '<tr>',
			'heading_previous_cell'		=> '<th><a href="{previous_url}">&lt;&lt;</a></th>',
			'heading_title_cell'		=> '<th colspan="{colspan}">{heading}</th>',
			'heading_next_cell'			=> '<th><a href="{next_url}">&gt;&gt;</a></th>',
			'heading_row_end'			=> '</tr>',
			'week_row_start'			=> '<tr>',
			'week_day_cell'				=> '<td>{week_day}</td>',
			'week_row_end'				=> '</tr>',
			'cal_row_start'				=> '<tr>',
			'cal_cell_start'			=> '<td>',
			'cal_cell_start_today'		=> '<td>',
			'cal_cell_start_other'		=> '<td style="color: #666;">',
			'cal_cell_content'			=> '<br><a href="{link}">{text}</a>',
			'cal_cell_content_today'	=> '<br><a href="{link}"><strong>{text}</strong></a>',
			'cal_cell_no_content'		=> '{day}',
			'cal_cell_no_content_today'	=> '<strong>{day}</strong>',
			'cal_cell_blank'			=> '&nbsp;',
			'cal_cell_other'			=> '{day}',
			'cal_cell_end'				=> '</td>',
			'cal_cell_end_today'		=> '</td>',
			'cal_cell_end_other'		=> '</td>',
			'cal_row_end'				=> '</tr>',
			'table_close'				=> '</table>'
		);
        $this->load->library('Re_Calendar', $prefs);
        $data = array(
            24  => array(
                array(
                    'link' => 'http://example.com/news/article/2006/06/03/',
                    'text' => 'magia'
                ),
                array(
                    'link' => 'http://example.com/news/article/2006/06/04/',
                    'text' => 'potagia'
                )
            ),
            
            2  => array(
                array(
                    'link' => 'http://example.com/news/article/2006/06/03/',
                    'text' => 'magia'
                ),
                array(
                    'link' => 'http://example.com/news/article/2006/06/04/',
                    'text' => 'potagia'
                )
            ),
        );
        $cur_year	= date('Y', time());
		$cur_month	= date('m', time());
        echo $this->re_calendar->generate($cur_year, $cur_month, $data);
        
        
    }
    
    public function calendar1() {
         $prefs = array(
            'show_next_prev'  => TRUE,
            'next_prev_url'   => 'http://example.com/index.php/calendar/show/',
            'template'=>'
                {table_open}<table cellpadding="1" cellspacing="2">{/table_open}
                
                {heading_row_start}<tr>{/heading_row_start}
                
                {heading_previous_cell}<th class="prev_sign"><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
                {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
                {heading_next_cell}<th class="next_sign"><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
                
                {heading_row_end}</tr>{/heading_row_end}
                
                {week_row_start}<tr class="week_name" >{/week_row_start}
                {week_day_cell}<td >{week_day}</td>{/week_day_cell}
                {week_row_end}</tr>{/week_row_end}
                
                {cal_row_start}<tr>{/cal_row_start}
                {cal_cell_start}<td>{/cal_cell_start}
                
                {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
                {cal_cell_content_today}<strong><a href="{content}">{day}</a></strong>{/cal_cell_content_today}
                
                {cal_cell_no_content}{day}{/cal_cell_no_content}
                {cal_cell_no_content_today}<strong>{day}</strong>{/cal_cell_no_content_today}
                
                {cal_cell_blank}&nbsp;{/cal_cell_blank}
                
                {cal_cell_end}</td>{/cal_cell_end}
                {cal_row_end}</tr>{/cal_row_end}
                
                {table_close}</table>{/table_close}'
        );
        $this->load->library('calendar', $prefs);
        $data = $this->generate_block(2, 6, 'http://example.com/news/article/2006/26/');
        echo $data = $this->calendar->generate(null, null, $data);
        
    }
    
    function generate_block($start, $end, $link){
        $block = array();
        for ($x = $start; $x <= $end; $x++) {
            $block[$x] = $link;
        }
        return $block;
    }
}