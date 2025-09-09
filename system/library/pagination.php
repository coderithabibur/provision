<?php
class Pagination {
    public $total = 0;
    public $page = 1;
    public $limit = 20;
    public $num_links = 8;
    public $url = '';
    public $text_first = '|&lt;';
    public $text_last = '&gt;|';
    public $text_next = '<i aria-hidden="true" class="fa fa-angle-right"></i>';
    public $text_prev = '<i aria-hidden="true" class="fa fa-angle-left"></i>';
    public function render() {
        $total = $this->total;
        if ($this->page < 1) {
            $page = 1;
        } else {
            $page = $this->page;
        }
        if (!(int)$this->limit) {
            $limit = 10;
        } else {
            $limit = $this->limit;
        }
        $num_links = $this->num_links;
        $num_pages = ceil($total / $limit);
        $this->url = str_replace('%7Bpage%7D', '{page}', $this->url);
        $output = '<ul class="pagination">';
        if ($page > 1) {
            //$output .= '<li><a href="' . str_replace('{page}', 1, $this->url) . '">' . $this->text_first . '</a></li>';
            $output .= '<li class="prev" style = "height: 44px;width: 44px;" ><a href="' . str_replace('{page}', $page - 1, $this->url) . '" style = "height: 44px;width: 44px;">' . $this->text_prev . '<span class="sr-only">prev</span></a></li>';
        }
        if ($num_pages > 1) {
            if ($num_pages <= $num_links) {
                $start = 1;
                $end = $num_pages;
            } else {
                $start = $page - floor($num_links / 2);
                $end = $page + floor($num_links / 2);
                if ($start < 1) {
                    $end += abs($start) + 1;
                    $start = 1;
                }
                if ($end > $num_pages) {
                    $start -= ($end - $num_pages);
                    $end = $num_pages;
                }
            }
            for ($i = $start; $i <= $end; $i++) {
                if ($page == $i) {
                    $output .= '<li class="active" style = "height: 44px;width: 44px;"><a href="javascript:void(0)" class="active" style = "height: 44px;width: 44px;">' . $i . '</a></li>';
                } else {
                    $output .= '<li style = "height: 44px;width: 44px;" ><a href="' . str_replace('{page}', $i, $this->url) . '" style = "height: 44px;width: 44px;">' . $i . '</a></li>';
                }
            }
        }
        if ($page < $num_pages) {
            $output .= '<li class="next" style = "height: 44px;width: 44px;"><a href="' . str_replace('{page}', $page + 1, $this->url) . '" style = "height: 44px;width: 44px;">' . $this->text_next . '<span class="sr-only">next</span></a></li>';
            //$output .= '<li><a href="' . str_replace('{page}', $num_pages, $this->url) . '">' . $this->text_last . '</a></li>';
        }
        $output .= '</ul>';
        if ($num_pages > 1) {
            return $output;
        } else {
            return '';
        }
    }
}