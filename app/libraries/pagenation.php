<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pagenation
 *
 * @createtime 2015-6-18 13:22:54
 * 
 * @author ZhangPing'an
 * 
 * @todo pagenation
 * 
 * @copyright (c) 2014--2015, Aman Doe www.koyuko.com
 * 
 */
class pagenation {

    /**
     *
     * @param 分页参数
     *
     * @ignore $totle_count 总条数
     *
     * @ignore $per_count  每页显示的条数
     *
     * @ignore $now_page  当前第几页
     *
     *
     */
    function getPage($totle_count, $page_size, $now_page) {
        $totle_page = ceil(intval($totle_count) / intval($page_size));
        $pre_page = intval($now_page) - 1;
        $next_page = intval($now_page) + 1;
        $html = "<div id='pageurl' class='message' >共<i class='blue'>" . $totle_count . "</i>条数据 分为<i class='blue'>" . $totle_page . "</i>页  每页显示<i class='blue'>" . $page_size . "</i>条 当前第<i class='blue'>" . $now_page . "</i>页</div>";
        $html.=' <ul class="paginList">';
        if ($now_page != 1) {//是否显示首页
            $html.="<li class='paginItem'><a href='#' onclick='return getPageUrl(1);return false' >首页</a></li>";
        }
        if ($now_page > 1) {//是否显示上一页
            $html.="<li class='paginItem'><a href='#' onclick='return getPageUrl(" . $pre_page . ");return false' ><span class='pagepre'></span></a></li> ";
        }
        /* 中间数字循环链接开始 */
        if ($totle_page <= 4) {//当总页数小于等于4时
            for ($i = 1; $i <= $totle_page; $i++) {
                if ($now_page == $i) {
                    $html.="<li class='paginItem current' ><a href='#'>" . $i . "</a>  </li>";
                } else {
                    $html.="<li class='paginItem'><a href='#' onclick='return getPageUrl(" . $i . ");return false'>" . $i . "</a>  </li>";
                }
            }
        }
        if ($totle_page >= 5) {//当总页数大于等于5时
            if ($now_page < 3) {//当 当前页为小于3时，及等于1或者等于2
                for ($i = 1; $i <= 5; $i++) {
                    if ($now_page == $i) {
                        $html.="<li class='paginItem current' ><a href='#'>" . $i . "</a></li> ";
                    } else {
                        $html.="<li class='paginItem'><a href='#' onclick='return getPageUrl(" . $i . ");return false'>" . $i . "</a> </li>";
                    }
                }
            } else if ($now_page >= 3 && $now_page <= intval($totle_page) - 2) {//当 当前页大于3且小于总页数减2时
                for ($i = intval($now_page) - 2; $i <= intval($now_page) + 2; $i++) {
                    if ($now_page == $i) {
                        $html.="<li class='paginItem current' ><a href='#'>" . $i . "</a></li> ";
                    } else {
                        $html.="<li  class='paginItem'><a href='#' onclick='return getPageUrl(" . $i . ");return false' >" . $i . "</a></li> ";
                    }
                }
            } else {
                for ($i = intval($totle_page) - 4; $i <= $totle_page; $i++) {
                    if ($now_page == $i) {
                        $html.="<li  class='paginItem current'><a href='#'>" . $i . "</a></li>";
                    } else {
                        $html.="<li  class='paginItem'><a href='#' onclick='return getPageUrl(" . $i . ");return false'>" . $i . "</a></li> ";
                    }
                }
            }
        }

        /* 中间数字循环连接结束 */
        if ($now_page < $totle_page) {//是否显示下一页
            $html.="<li  class='paginItem'><a href='#' onclick='return getPageUrl(" . $next_page . ");return false'><span class='pagenxt'></span></a></li>";
        }
        if ($totle_page != $now_page) {//是否显示尾页
            $html.="<li  class='paginItem'><a href='#' onclick='return getPageUrl(" . $totle_page . ");return false'>末页</a> </li>";
        }
        $html.="</ul></div>";
        return $html;
    }

    /**
     * 
     * @todo 获取前台分页 
     * 
     * @param $totle_count 总条数
     * 
     * @param $page_size 每页显示条数
     * 
     * @param $now_page 当前第几页
     * 
     * @param $url 基本链接
     * 
     * @param $search 链接参数
     * 
     */
    public function getFrontPageUrl($totle_count, $page_size, $now_page, $url, $search = '') {
        //获取总页数
        $totle_page = ceil(intval($totle_count) / intval($page_size));
        if ($totle_page <= 1) {
            return;
        }
        //上一页
        $pre_page = intval($now_page) - 1;
        if ($pre_page == 0) {
            $pre_page = 1;
        }
        //下一页
        $next_page = intval($now_page) + 1;
        if ($next_page > $totle_page) {
            $next_page = $totle_page;
        }
        $html = '';
        if ($totle_page > 1 && $now_page > 1) {
            $html.= '<a href="' . $url . '?page=1&' . http_build_query($search) . '">&nbsp;&nbsp;&nbsp;&nbsp;首页&nbsp;&nbsp;&nbsp;&nbsp;</a>';
        }
        //显示上一页
        if ($now_page > 1) {
            $html.='<a href="' . $url . '?page=' . $pre_page . '&' . http_build_query($search) . '">上一页</a>';
        }
        if ($now_page > 3 && $totle_page > 6) {
            $html.= '<a href="' . $url . '?page=1&' . http_build_query($search) . '">1</a>';
            $html.='<a>...</a>';
        }
        //总页数<=5时
        if ($totle_page <= 5) {
            for ($num = 1; $num <= $totle_page; $num++) {
                if ($now_page == $num) {
                    $html.='<span class="current">' . $num . '</span>';
                } else {
                    $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                }
            }
        } else {//总页数大于5
            if ($now_page < 3) {//当前页小于3
                for ($num = 1; $num <= 5; $num++) {
                    if ($now_page == $num) {
                        $html.='<span class="current">' . $num . '</span>';
                    } else {
                        $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                    }
                }
            } else if ($now_page >= 3 && $now_page <= intval($totle_page) - 2) {
                for ($num = intval($now_page) - 2; $num <= intval($now_page) + 2; $num++) {
                    if ($now_page == $num) {
                        $html.='<span class="current">' . $num . '</span>';
                    } else {
                        $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                    }
                }
            } else {
                for ($num = intval($totle_page) - 4; $num <= $totle_page; $num++) {
                    if ($now_page == $num) {
                        $html.='<span class="current">' . $num . '</span>';
                    } else {
                        $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                    }
                }
            }
        }
        if ($now_page < $totle_page - 4 && $totle_page > 6) {
            $html.='<a>...</a>';
            $html.= '<a href="' . $url . '?page=' . $totle_page . '&' . http_build_query($search) . '">' . $totle_page . '</a>';
        }
        //显示下一页
        if ($now_page != $totle_page && $totle_page > 1) {
            $html.='<a href="' . $url . '?page=' . $next_page . '&' . http_build_query($search) . '">下一页</a>';
        }
        return $html;
    }

    /**
     * 
     * @todo 获取前台理财师
     * 
     * @param $totle_count 总条数
     * 
     * @param $page_size 每页显示条数
     * 
     * @param $now_page 当前第几页
     * 
     * @param $url 基本链接
     * 
     * @param $search 链接参数
     * 
     */
    public function getFrontStarUrl($totle_count, $page_size, $now_page, $url, $search = '') {
        //获取总页数
        $totle_page = ceil(intval($totle_count) / intval($page_size));
        if ($totle_page <= 1) {
            return;
        }
        //上一页
        $pre_page = intval($now_page) - 1;
        if ($pre_page == 0) {
            $pre_page = 1;
        }
        //下一页
        $next_page = intval($now_page) + 1;
        if ($next_page > $totle_page) {
            $next_page = $totle_page;
        }
        $html = '';
        if ($totle_page > 1 && $now_page > 1) {
            $html.= '<a href="' . $url . '?page=1&' . http_build_query($search) . '"  style="padding:2px 17px;">首页</a>';
        }
        //显示上一页
        if ($now_page > 1) {
            $html.='<a href="' . $url . '?page=' . $pre_page . '&' . http_build_query($search) . '"  style="padding:2px 11px;">上一页</a>';
        }
        if ($now_page > 3 && $totle_page > 6) {
            $html.= '<a href="' . $url . '?page=1&' . http_build_query($search) . '">1</a>';
            $html.='<a>...</a>';
        }
        //总页数<=5时
        if ($totle_page <= 5) {
            for ($num = 1; $num <= $totle_page; $num++) {
                if ($now_page == $num) {
                    $html.='<span class="current">' . $num . '</span>';
                } else {
                    $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                }
            }
        } else {//总页数大于5
            if ($now_page < 3) {//当前页小于3
                for ($num = 1; $num <= 5; $num++) {
                    if ($now_page == $num) {
                        $html.='<span class="current">' . $num . '</span>';
                    } else {
                        $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                    }
                }
            } else if ($now_page >= 3 && $now_page <= intval($totle_page) - 2) {
                for ($num = intval($now_page) - 2; $num <= intval($now_page) + 2; $num++) {
                    if ($now_page == $num) {
                        $html.='<span class="current">' . $num . '</span>';
                    } else {
                        $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                    }
                }
            } else {
                for ($num = intval($totle_page) - 4; $num <= $totle_page; $num++) {
                    if ($now_page == $num) {
                        $html.='<span class="current">' . $num . '</span>';
                    } else {
                        $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                    }
                }
            }
        }
        if ($now_page < $totle_page - 4 && $totle_page > 6) {
            $html.='<a>...</a>';
            $html.= '<a href="' . $url . '?page=' . $totle_page . '&' . http_build_query($search) . '">' . $totle_page . '</a>';
        }
        //显示下一页
        if ($now_page != $totle_page && $totle_page > 1) {
            $html.='<a href="' . $url . '?page=' . $next_page . '&' . http_build_query($search) . '"  style="padding:2px 11px;">下一页</a>';
            $html.='<a href="' . $url . '?page=' . $totle_page . '&' . http_build_query($search) . '" style="padding:2px 17px;">末页</a>';
        }
        return $html;
    }

    /**
     * 
     * @todo 获取积分产品
     * 
     * @param $totle_count 总条数
     * 
     * @param $page_size 每页显示条数
     * 
     * @param $now_page 当前第几页
     * 
     * @param $url 基本链接
     * 
     * @param $search 链接参数
     * 
     */
    public function getFrontPointUrl($totle_count, $page_size, $now_page, $url, $search = '') {
        //获取总页数
        $totle_page = ceil(intval($totle_count) / intval($page_size));
        if ($totle_page <= 1) {
            return;
        }
        //上一页
        $pre_page = intval($now_page) - 1;
        if ($pre_page == 0) {
            $pre_page = 1;
        }
        //下一页
        $next_page = intval($now_page) + 1;
        if ($next_page > $totle_page) {
            $next_page = $totle_page;
        }
        $html = '';
        if ($totle_page > 1 && $now_page > 1) {
            $html.= '<a href="' . $url . '?page=1&' . http_build_query($search) . '"  style="padding:2px 17px;">首页</a>';
        }
        //显示上一页
        if ($now_page > 1) {
            $html.='<a href="' . $url . '?page=' . $pre_page . '&' . http_build_query($search) . '"  style="padding:2px 11px;">上一页</a>';
        }
        if ($now_page > 3 && $totle_page > 6) {
            $html.= '<a href="' . $url . '?page=1&' . http_build_query($search) . '">1</a>';
            $html.='<a>...</a>';
        }
        //总页数<=5时
        if ($totle_page <= 5) {
            for ($num = 1; $num <= $totle_page; $num++) {
                if ($now_page == $num) {
                    $html.='<span class="current">' . $num . '</span>';
                } else {
                    $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                }
            }
        } else {//总页数大于5
            if ($now_page < 3) {//当前页小于3
                for ($num = 1; $num <= 5; $num++) {
                    if ($now_page == $num) {
                        $html.='<span class="current">' . $num . '</span>';
                    } else {
                        $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                    }
                }
            } else if ($now_page >= 3 && $now_page <= intval($totle_page) - 2) {
                for ($num = intval($now_page) - 2; $num <= intval($now_page) + 2; $num++) {
                    if ($now_page == $num) {
                        $html.='<span class="current">' . $num . '</span>';
                    } else {
                        $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                    }
                }
            } else {
                for ($num = intval($totle_page) - 4; $num <= $totle_page; $num++) {
                    if ($now_page == $num) {
                        $html.='<span class="current">' . $num . '</span>';
                    } else {
                        $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                    }
                }
            }
        }
        if ($now_page < $totle_page - 4 && $totle_page > 6) {
            $html.='<a>...</a>';
            $html.= '<a href="' . $url . '?page=' . $totle_page . '&' . http_build_query($search) . '">' . $totle_page . '</a>';
        }
        //显示下一页
        if ($now_page != $totle_page && $totle_page > 1) {
            $html.='<a href="' . $url . '?page=' . $next_page . '&' . http_build_query($search) . '"  style="padding:2px 11px;">下一页</a>';
            $html.='<a href="' . $url . '?page=' . $totle_page . '&' . http_build_query($search) . '" style="padding:2px 17px;">末页</a>';
        }
        return $html;
    }

    /**
     * 
     * @todo 获取社区分页
     * 
     * @param $totle_count 总条数
     * 
     * @param $page_size 每页显示条数
     * 
     * @param $now_page 当前第几页
     * 
     * @param $url 基本链接
     * 
     * @param $search 链接参数
     * 
     */
    public function getFrontBbsUrl($totle_count, $page_size, $now_page, $url, $search = '') {
        //获取总页数
        $totle_page = ceil(intval($totle_count) / intval($page_size));
        //上一页
        $pre_page = intval($now_page) - 1;
        if ($pre_page == 0) {
            $pre_page = 1;
        }
        //下一页
        $next_page = intval($now_page) + 1;
        if ($next_page > $totle_page) {
            $next_page = $totle_page;
        }
        $html = '';
        if ($totle_page > 1 && $now_page > 1) {
            $html.= '<a href="' . $url . '?page=1&' . http_build_query($search) . '"  style="padding:4px 25px;">首页</a>';
        }
        //显示上一页
        if ($now_page > 1) {
            $html.='<a href="' . $url . '?page=' . $pre_page . '&' . http_build_query($search) . '"  style="padding:4px 25px;">上一页</a>';
        }
        if ($now_page > 3 && $totle_page > 6) {
            $html.= '<a href="' . $url . '?page=1&' . http_build_query($search) . '">1</a>';
            $html.='<a>...</a>';
        }
        //总页数<=5时
        if ($totle_page <= 5) {
            for ($num = 1; $num <= $totle_page; $num++) {
                if ($now_page == $num) {
                    $html.='<span class="current">' . $num . '</span>';
                } else {
                    $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                }
            }
        } else {//总页数大于5
            if ($now_page < 3) {//当前页小于3
                for ($num = 1; $num <= 5; $num++) {
                    if ($now_page == $num) {
                        $html.='<span class="current">' . $num . '</span>';
                    } else {
                        $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                    }
                }
            } else if ($now_page >= 3 && $now_page <= intval($totle_page) - 2) {
                for ($num = intval($now_page) - 2; $num <= intval($now_page) + 2; $num++) {
                    if ($now_page == $num) {
                        $html.='<span class="current">' . $num . '</span>';
                    } else {
                        $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                    }
                }
            } else {
                for ($num = intval($totle_page) - 4; $num <= $totle_page; $num++) {
                    if ($now_page == $num) {
                        $html.='<span class="current">' . $num . '</span>';
                    } else {
                        $html.='<a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '">' . $num . '</a>';
                    }
                }
            }
        }
        if ($now_page < $totle_page - 4 && $totle_page > 6) {
            $html.='<a>...</a>';
            $html.= '<a href="' . $url . '?page=' . $totle_page . '&' . http_build_query($search) . '">' . $totle_page . '</a>';
        }
        //显示下一页
        if ($now_page != $totle_page && $totle_page > 1) {
            $html.='<a href="' . $url . '?page=' . $next_page . '&' . http_build_query($search) . '"  style="padding:2px 11px;">下一页</a>';
            $html.='<a href="' . $url . '?page=' . $totle_page . '&' . http_build_query($search) . '" style="padding:2px 17px;">末页</a>';
        }
        if ($totle_count > 0) {
            $html.='<p class="inb">共' . $totle_page . '页</p>';
        }
        return $html;
    }
    
    
     /**
     * 
     * @todo 获取站内信
     * 
     * @param $totle_count 总条数
     * 
     * @param $page_size 每页显示条数
     * 
     * @param $now_page 当前第几页
     * 
     * @param $url 基本链接
     * 
     * @param $search 链接参数
     * 
     */
    public function getFrontMessageUrl($totle_count, $page_size, $now_page, $url, $search = '') {
        //获取总页数
        $totle_page = ceil(intval($totle_count) / intval($page_size));
        if ($totle_page <= 1) {
            return;
        }
        //上一页
        $pre_page = intval($now_page) - 1;
        if ($pre_page == 0) {
            $pre_page = 1;
        }
        //下一页
        $next_page = intval($now_page) + 1;
        if ($next_page > $totle_page) {
            $next_page = $totle_page;
        }
        $html = '';
        if ($totle_page > 1 && $now_page > 1) {
            $html.= '<li><a href="' . $url . '?page=1&' . http_build_query($search) . '" class="znxx_mn_pager_btn">首页</a></li>';
        }
        //显示上一页
        if ($now_page > 1) {
            $html.='<li><a href="' . $url . '?page=' . $pre_page . '&' . http_build_query($search) . '" class="znxx_mn_pager_btn">上一页</a></li>';
        }
        if ($now_page > 3 && $totle_page > 6) {
            $html.= '<li><a href="' . $url . '?page=1&' . http_build_query($search) . '" class="znxx_mn_pager_btn">1</a></li>';
            $html.='<li><a>...</a></li>';
        }
        //总页数<=5时
        if ($totle_page <= 5) {
            for ($num = 1; $num <= $totle_page; $num++) {
                if ($now_page == $num) {
                    $html.='<li><span class="znxx_mn_pager_btn">' . $num . '</span></li>';
                } else {
                    $html.='<li><a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '" class="znxx_mn_pager_btn">' . $num . '</a></li>';
                }
            }
        } else {//总页数大于5
            if ($now_page < 3) {//当前页小于3
                for ($num = 1; $num <= 5; $num++) {
                    if ($now_page == $num) {
                        $html.='<li><span class="znxx_mn_pager_btn">' . $num . '</span></li>';
                    } else {
                        $html.='<li><a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '" class="znxx_mn_pager_btn">' . $num . '</a></li>';
                    }
                }
            } else if ($now_page >= 3 && $now_page <= intval($totle_page) - 2) {
                for ($num = intval($now_page) - 2; $num <= intval($now_page) + 2; $num++) {
                    if ($now_page == $num) {
                        $html.='<span class="znxx_mn_pager_btn">' . $num . '</span></li>';
                    } else {
                        $html.='<li><a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '" class="znxx_mn_pager_btn">' . $num . '</a></li>';
                    }
                }
            } else {
                for ($num = intval($totle_page) - 4; $num <= $totle_page; $num++) {
                    if ($now_page == $num) {
                        $html.='<li><span class="znxx_mn_pager_btn">' . $num . '</span></li>';
                    } else {
                        $html.='<li><a href="' . $url . '?page=' . $num . '&' . http_build_query($search) . '" class="znxx_mn_pager_btn">' . $num . '</a></li>';
                    }
                }
            }
        }
        if ($now_page < $totle_page - 4 && $totle_page > 6) {
            $html.='<li><a>...</a></li>';
            $html.= '<li><a href="' . $url . '?page=' . $totle_page . '&' . http_build_query($search) . '" class="znxx_mn_pager_btn">' . $totle_page . '</a><li>';
        }
        //显示下一页
        if ($now_page != $totle_page && $totle_page > 1) {
            $html.='<li><a href="' . $url . '?page=' . $next_page . '&' . http_build_query($search) . '"  class="znxx_mn_pager_btn">下一页</a></li>';
            $html.='<li><a href="' . $url . '?page=' . $totle_page . '&' . http_build_query($search) . '" class="znxx_mn_pager_btn">末页</a></li>';
        }
        return $html;
    }
}
