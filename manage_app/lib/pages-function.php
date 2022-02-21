<?php
class Paginator
{
    public $items_per_page;
    public $items_total;
    public $current_page;
    public $num_pages;
    public $mid_range;
    public $low;
    public $high;
    public $limit;
    public $return;
    public $default_ipp;
    public $querystring;
    public $url_next;

    public function Paginator()
    {
        $this->current_page = 1;
        $this->mid_range = 7;
        $this->items_per_page = $this->default_ipp;
        $this->url_next = $this->url_next;
    }
    public function paginate()
    {

        if (!is_numeric($this->items_per_page) or $this->items_per_page <= 0) {
            $this->items_per_page = $this->default_ipp;
        }

        $this->num_pages = ceil($this->items_total / $this->items_per_page);

        if ($this->current_page < 1 or !is_numeric($this->current_page)) {
            $this->current_page = 1;
        }

        if ($this->current_page > $this->num_pages) {
            $this->current_page = $this->num_pages;
        }

        $prev_page = $this->current_page - 1;
        $next_page = $this->current_page + 1;

        if ($this->num_pages > 10) {
            $this->return = ($this->current_page != 1 and $this->items_total >= 10) ? "<a class=\"btn btn-link btn-icon\" href=\"" . 'javascript:pages_change('.$prev_page.');' . "\"><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-left'><polyline points='15 18 9 12 15 6'></polyline></svg></a> " : "<span class=\"btn btn-link btn-icon\" href=\"#\"><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='grey' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-left'><polyline points='15 18 9 12 15 6'></polyline></svg></span> ";

            $this->start_range = $this->current_page - floor($this->mid_range / 2);
            $this->end_range = $this->current_page + floor($this->mid_range / 2);

            if ($this->start_range <= 0) {
                $this->end_range += abs($this->start_range) + 1;
                $this->start_range = 1;
            }
            if ($this->end_range > $this->num_pages) {
                $this->start_range -= $this->end_range - $this->num_pages;
                $this->end_range = $this->num_pages;
            }
            $this->range = range($this->start_range, $this->end_range);

            for ($i = 1; $i <= $this->num_pages; $i++) {
                if ($this->range[0] > 2 and $i == $this->range[0]) {
                    $this->return .= " <button type=\"button\" class=\"btn btn-icon  bg-white\">...</button> ";
                }

                if ($i == 1 or $i == $this->num_pages or in_array($i, $this->range)) {
                    $this->return .= ($i == $this->current_page and $_GET['Page'] != 'All') ? "<a title=\"Go to page $i of $this->num_pages\" class=\"btn btn-icon  btn-dark\" href=\"javascript:pages_change($i);\">$i</a> " : "<a class=\"btn btn-icon  btn-light\" title=\"Go to page $i of $this->num_pages\" href=\"" . 'javascript:pages_change('.$i.');' . "\">$i</a> ";
                }
                if ($this->range[$this->mid_range - 1] < $this->num_pages - 1 and $i == $this->range[$this->mid_range - 1]) {
                    $this->return .= " <button type=\"button\" class=\"btn btn-icon  bg-white\">...</button> ";
                }

            }
            $this->return .= (($this->current_page != $this->num_pages and $this->items_total >= 10) and ($_GET['Page'] != 'All')) ? "<a class=\"btn btn-link btn-icon\" href=\"" . 'javascript:pages_change('.$next_page.');' . "\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"black\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-chevron-right\"><polyline points=\"9 18 15 12 9 6\"></polyline></svg></a>\n" : "<span class=\"btn btn-link btn-icon\" href=\"#\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"grey\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-chevron-right\"><polyline points=\"9 18 15 12 9 6\"></polyline></svg></span>\n";
        } else {
            for ($i = 1; $i <= $this->num_pages; $i++) {
                $this->return .= ($i == $this->current_page) ? "<a class=\"btn btn-icon  btn-dark\" href=\"javascript:pages_change($i);\">$i</a> " : "<a class=\"btn btn-icon  btn-light\" href=\"" . 'javascript:pages_change('.$i.');' . "\">$i</a> ";
            }
        }
        $this->low = ($this->current_page - 1) * $this->items_per_page;
        $this->high = ($_GET['ipp'] == 'All') ? $this->items_total : ($this->current_page * $this->items_per_page) - 1;
        $this->limit = ($_GET['ipp'] == 'All') ? "" : " LIMIT $this->low,$this->items_per_page";
    }

    public function display_pages()
    {
        return $this->return;
    }
}


function page_navi($total_item, $cur_page, $per_page=10, $query_str="", $min_page=5){

	$total_page = ceil($total_item/$per_page);
	$cur_page = (isset($cur_page))?$cur_page:1;
	$diff_page = NULL;
	if($cur_page>$min_page){
		$diff_page = $total_page-$cur_page;
	}
	$limit_page = $min_page;
	$f_num_page = ($cur_page<=$min_page)?1:(floor($cur_page/$min_page)*$min_page)+1;
	if($diff_page>$min_page){
		$limit_page = ($min_page + $f_num_page)-1;
	}else{
		if(isset($diff_page)){
			$limit_page = $total_page;
		}else{
			$limit_page = $min_page;
		}
	}
	$show_page = ($total_page<=$min_page)?$total_page:$limit_page;
	$l_num_page = 1;
	$prev_page = $cur_page-1;
	$next_page = $cur_page+1;
	$temp_query_str = $query_str;
	$query_str = "";
	if($temp_query_str && is_array($temp_query_str) && count($temp_query_str)>0){
		array_pop($temp_query_str);
		$query_str = http_build_query($temp_query_str);
		if($query_str!=""){
			$query_str = "?".$query_str;
		}
	}
	$mark_char = ($query_str!="")?"&":"?";

	  echo '<nav>
		  <ul class="pagination justify-content-center">
			<li class="page-item">
			<a class="page-link" href="'.'javascript:pages_change(1);'.'"> First</a>
			</li>
			';
		echo '
			<li class="page-item '.(($cur_page==1)?"disabled":"").'">
			  <a class="page-link"  href="'.'javascript:pages_change('.$prev_page.');'.'"> Previous</a>
			</li>
		';
		for($i = $f_num_page; $i<=$show_page;$i++){
		echo '
			<li class="page-item '.(($i==$cur_page)?"active":"").'">
			  <a class="page-link" href="'.'javascript:pages_change('.$i.');'.'"> '.$i.' </a>
			</li>
		';
		}
		echo '
			<li class="page-item '.(($next_page>$total_page)?"disabled":"").'">
				<a class="page-link"  href="'.'javascript:pages_change('.$next_page.');'.'"> Next</a>
			</li>
		';
		echo '
			<li class="page-item">
			  <input type="number" class="form-control" min="1" max="'.$total_page.'"
					  style="width:80px;" onClick="javascript:pages_change('.$cur_page.');" value="'.$cur_page.'" />
			</li>
		';
		echo '
			<li class="page-item">
				<a class="page-link"  href="'.'javascript:pages_change('.$total_page.');'.'"> Last</a>
			</li>
		  </ul>
		</nav>
		';
	}
