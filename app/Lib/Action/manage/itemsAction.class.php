<?php
class itemsAction extends BackendAction {	
    public function _initialize() {
        parent::_initialize();
        $this->_mod = D('items');
        $this->_cate_mod = D('items_cate'); 		
    }

    public function _before_index() {

        //分类信息
        $res = $this->_cate_mod->field('id,name')->select();
        $cate_list = array();
        foreach ($res as $val) {
            $cate_list[$val['id']] = $val['name'];
        }
        $this->assign('cate_list', $cate_list);
        //默认排序
        $this->sort = 'ordid ASC,';
        $this->order ='add_time DESC';
    }
public function ajax_upload_img() {
	    $type = $this->_get('type', 'trim', 'img');
        //上传图片
        if (!empty($_FILES[$type]['name'])) {
		    $dir = date('ym/d/');
            $result = $this->_upload($_FILES['img'], 'item/'. $dir, array('width'=>'290', 'height'=>'190'));
            if ($result['error']) {
                $this->ajaxReturn(0, $result['info']);
            } else {
			    $savename = $dir . $result['info'][0]['savename'];
                $ext = array_pop(explode('.', $savename));
                $data['img'] = str_replace('.' . $ext, '_thumb.' . $ext, $savename);
                $this->ajaxReturn(1, L('operation_success'), $data['img']);
            }
        } else {
            $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }
    protected function _search() {
        $map = array();
        ($time_start = $this->_request('time_start', 'trim')) && $map['add_time'][] = array('egt', strtotime($time_start));
        ($time_end = $this->_request('time_end', 'trim')) && $map['add_time'][] = array('elt', strtotime($time_end)+(24*60*60-1));
        ($price_min = $this->_request('price_min', 'trim')) && $map['price'][] = array('egt', $price_min);
        ($price_max = $this->_request('price_max', 'trim')) && $map['price'][] = array('elt', $price_max);
        ($rates_min = $this->_request('rates_min', 'trim')) && $map['coupon_rate'][] = array('egt', $rates_min);
        ($rates_max = $this->_request('rates_max', 'trim')) && $map['coupon_rate'][] = array('elt', $rates_max);
        ($nick = $this->_request('nick', 'trim')) && $map['nick'] = array('like', '%'.$nick.'%');
        $cate_id = $this->_request('cate_id', 'intval');
        if ($cate_id) {
            $id_arr = $this->_cate_mod->get_child_ids($cate_id, true);
            $map['cate_id'] = array('IN', $id_arr);
            $spid = $this->_cate_mod->where(array('id'=>$cate_id))->getField('spid');
            if( $spid==0 ){
                $spid = $cate_id;
            }else{
                $spid .= $cate_id;
            }
        }
        $map['pass'] = 1;
        ($keyword = $this->_request('keyword', 'trim')) && $map['title'] = array('like', '%'.$keyword.'%');
        $this->assign('search', array(
            'time_start' => $time_start,
            'time_end' => $time_end,
            'price_min' => $price_min,
            'price_max' => $price_max,
            'rates_min' => $rates_min,
            'rates_max' => $rates_max,
            'nick' => $nick,
            'pass' =>$pass,
            'selected_ids' => $spid,
            'cate_id' => $cate_id,
            'keyword' => $keyword,
        ));
        return $map;
    }
	private function __getItemsOrig()
{
$orig=M('items_orig')->field('id,type')->select();
$result=array();
if(!is_array($orig))
$orig=array();
foreach($orig as $item)
{
$result[$item['type']]=$item['id'];
}
return $result;
}

        public function add() {
if (IS_POST) {
if (FALSE === ( $data = $this->_mod->create() )) {
$this->error($this->_mod->getError());
}
if (!trim($data['cate_id'])) {
$this->error("请选择商品分类");
}
if($this->_mod->where(array('num_iid'=>$data['num_iid']))->count())
{
	$this->error('商品已存在，请更换其他商品');
}
if(empty($data['click_url']))
{
$data['click_url']='';
}
//$data['shop_type']=M('items_orig')->where(array('id'=>$data['orig_id']))->getField('type');
$data['shop_type'] = $_POST['shop_type'];
$data['ems']       = 1;
$data['likes']       = rand(99,9999);
if (!trim($data['volume'])) {
$this->error("请填写正确的销量");
}
$data['coupon_start_time']=  strtotime($_POST['coupon_start_time']);
$data['coupon_end_time']=  strtotime($_POST['coupon_end_time']);
$item_id=$this->_mod->add($data);
if (!$item_id) {
$this->error(l("operation_failure"));
}
$this->success(l("operation_success"));
}else {
$orig_list = m("items_orig")->where(array("pass"=>1))->select();
$this->assign("orig_list",$orig_list);
$this->display();
}
}
public function ajaxGetItem()
{
	
	if(!isset($_REQUEST['link']))
	$this->ajaxReturn (0,'未传入商品链接');
	$info = getInfo($_REQUEST['link']);
	$info['shop_type']='B';
	$info['orig_id']='';
	$tt = (string)($info['coupon_price'] / $info['price']);
	$tt = substr($tt, 0,4);  
	$info['coupon_rate'] = $tt * 10000;
$this->ajaxReturn(1,'',$info);
}

    public function edit() {
        if (IS_POST) {
            //获取数据
            if (false === $data = $this->_mod->create()) {
                $this->error($this->_mod->getError());
            }
            if( !$data['cate_id']||!trim($data['cate_id']) ){
                $this->error('请选择商品分类');
            }
            $item_id = $data['id'];
						$data['coupon_start_time'] = strtotime($data['coupon_start_time']);
						$data['coupon_end_time'] = strtotime($data['coupon_end_time']);
            //更新商品
            $this->_mod->where(array('id'=>$item_id))->save($data);
            $this->success(L('operation_success'));
        } else {
            $id = $this->_get('id','intval');
            $item = $this->_mod->where(array('id'=>$id))->find();
            //分类
            $spid = $this->_cate_mod->where(array('id'=>$item['cate_id']))->getField('spid');
            if( $spid==0 ){
                $spid = $item['cate_id'];
            }else{
                $spid .= $item['cate_id'];
            }
            $this->assign('selected_ids',$spid); //分类选中
            $this->assign('info', $item);
            //来源
            //p($item);
            $orig_list = M('items_orig')->select();
            $this->assign('orig_list', $orig_list);
            $this->display();
        }
    }

	public function clear(){
		if(IS_POST){
			if ($_REQUEST['isok'] == "1") {
				$action	= $this->_post('action', 'trim');
				$where = '1=1';
				if('outtime' == $action){
					$where.=" AND pass=1  AND coupon_end_time <".time();
				}elseif('notpass' == $action){
					$where.=" AND pass=0";
				}elseif('clear' == $action){
					$db_file = CONF_PATH . 'db.php';
					$db = require $db_file;
					$sql = 'TRUNCATE TABLE '.$db['DB_PREFIX'].'items ';
					$mes = M()->execute($sql);
					$this->success(L('clear_success'));
				}

				$ids_list = $this->_mod->where($where)->select();
				$ids = "";
				foreach ($ids_list as $val) {
				   $ids .= $val['id'] . ",";
				}
				if ($ids != "") {
				   $ids = substr($ids, 0, -1);
				   M('items_comment')->where("item_id in(" . $ids . ")")->delete();
				}
				
				$this->_mod->where($where)->delete();
				$this->success(L('clear_success'));
			}else{
				$this->success('确认是否要删除？', U('items/clear'));
			}
		}else{
			$this->display();
		}
	}


	public function delete_search() {
        if (isset($_REQUEST['dosubmit'])) {
            if ($_REQUEST['isok'] == "1") {
                //搜索
                $where = '1=1';
                $keyword = trim($_POST['keyword']);
                $cate_id = trim($_POST['cate_id']);
                $cate_id = trim($_POST['cate_id']);
                $time_start = trim($_POST['time_start']);
                $time_end = trim($_POST['time_end']);
                $status = trim($_POST['status']);
                $min_price = trim($_POST['min_price']);
                $max_price = trim($_POST['max_price']);
            
                if ($keyword != '') {
                    $where .= " AND title LIKE '%" . $keyword . "%'";
                }
                if ($cate_id != ''&&$cate_id!=0) {
                    $where .= " AND cate_id=" . $cate_id;
                }
                if ($time_start != '') {
                    $time_start_int = strtotime($time_start);
                    $where .= " AND coupon_end_time>='" . $time_start_int . "'";
                }
                if ($time_end != '') {
                    $time_end_int = strtotime($time_end);
                    $where .= " AND coupon_end_time<='" . $time_end_int . "'";
                }
                if ($status != '') {
                    $where .= " AND status=" . $status;
                }
                if ($min_price != '') {
                    $where .= " AND coupon_price>=" . $min_price;
                }
                if ($max_price != '') {
                    $where .= " AND coupon_price<=" . $max_price;
                }
                $ids_list = $this->_mod->where($where)->select();
                $ids = "";
                foreach ($ids_list as $val) {
                    $ids .= $val['id'] . ",";
                }
                if ($ids != "") {
                    $ids = substr($ids, 0, -1);
                }
                $this->_mod->where($where)->delete();
                $this->success('删除成功', U('items/clear'));
            } else {
                $this->success('确认是否要删除？', U('items/clear'));
            }
        } else {
            $this->display();
        }
    }


	/**
	 * 一键延时
	 */
	public function key_addtime(){
		if(IS_POST){
			$action	= $this->_post('action', 'trim');
			$where = '1=1';
			$where.=" AND pass=1  AND coupon_end_time <".time();
			if('aday' == $action){
				$datas['coupon_end_time']=time()+86400;
			}elseif('twday' == $action){
				$datas['coupon_end_time']=time()+2*86400;
			}elseif('trday' == $action){
				$datas['coupon_end_time']=time()+3*86400;
			}else{
				$times	= $this->_post('times', 'intval');
				!$times && $this->error('请输入延时时间',U('items/key_addtime'));
				$datas['coupon_end_time']=time()+$times*3600;
			}
				
			if ($datas) {
				$this->_mod->where($where)->save($datas);
				$this->success('延时成功！');
			}else{
				$this->error('错误',U('items/key_addtime'));
			}
		}else{
			$this->display();
		}
	}
 
    /**
     * 商品审核
     */
    public function check() {
		if($this->_request("sort", 'trim')) {
			$sort = $this->_request("sort", 'trim');
		}else {
			$sort = 'id';
		}
		if($this->_request("order", 'trim')) {
			$order = $this->_request("order", 'trim');
		}else {
			$order = 'DESC';
		}
        //分类信息
        $res = $this->_cate_mod->field('id,name')->select();
        $cate_list = array();
        foreach ($res as $val) {
            $cate_list[$val['id']] = $val['name'];
        }
        $this->assign('cate_list', $cate_list);
        //商品信息
        //$map = $this->_search();
        $map=array();
        $map['pass'] = 0;
				$map['status'] = 'underway';
        ($time_start = $this->_request('time_start', 'trim')) && $map['add_time'][] = array('egt', strtotime($time_start));
        ($time_end = $this->_request('time_end', 'trim')) && $map['add_time'][] = array('elt', strtotime($time_end)+(24*60*60-1));
        $cate_id = $this->_request('cate_id', 'intval');
        if ($cate_id) {
            $id_arr = $this->_cate_mod->get_child_ids($cate_id, true);
            $map['cate_id'] = array('IN', $id_arr);
            $spid = $this->_cate_mod->where(array('id'=>$cate_id))->getField('spid');
            if( $spid==0 ){
                $spid = $cate_id;
            }else{
                $spid .= $cate_id;
            }
        }
        ($keyword = $this->_request('keyword', 'trim')) && $map['title'] = array('like', '%'.$keyword.'%');
        $this->assign('search', array(
            'time_start' => $time_start,
            'time_end' => $time_end,
            'selected_ids' => $spid,
            'cate_id' => $cate_id,
            'keyword' => $keyword,
        ));
        //分页
        $count = $this->_mod->where($map)->count('id');
        $pager = new Page($count, 20);
        $select = $this->_mod->where($map)->order('id DESC');
        $select->limit($pager->firstRow.','.$pager->listRows);
				$select->order($sort . ' ' . $order);
        $page = $pager->show();
        $this->assign("page", $page);
        $listarr = $select->select();
        $lists = array();
        foreach($listarr as $key=>$val){
			$lists[$key]			= $val;
		}

        $this->assign('list', $lists);
        $this->assign('list_table', true);
        $this->display();
    }




	
    /**
     * 审核不通过
     */
    public function notcheck() {
		if($this->_request("sort", 'trim')) {
			$sort = $this->_request("sort", 'trim');
		}else {
			$sort = 'id';
		}
		if($this->_request("order", 'trim')) {
			$order = $this->_request("order", 'trim');
		}else {
			$order = 'DESC';
		}
        //分类信息
        $res = $this->_cate_mod->field('id,name')->select();
        $cate_list = array();
        foreach ($res as $val) {
            $cate_list[$val['id']] = $val['name'];
        }
        $this->assign('cate_list', $cate_list);
        //商品信息
        //$map = $this->_search();
        $map=array();
        $map['pass'] = 0;
		$map['status'] = 'fail';
        ($time_start = $this->_request('time_start', 'trim')) && $map['add_time'][] = array('egt', strtotime($time_start));
        ($time_end = $this->_request('time_end', 'trim')) && $map['add_time'][] = array('elt', strtotime($time_end)+(24*60*60-1));
        $cate_id = $this->_request('cate_id', 'intval');
        if ($cate_id) {
            $id_arr = $this->_cate_mod->get_child_ids($cate_id, true);
            $map['cate_id'] = array('IN', $id_arr);
            $spid = $this->_cate_mod->where(array('id'=>$cate_id))->getField('spid');
            if( $spid==0 ){
                $spid = $cate_id;
            }else{
                $spid .= $cate_id;
            }
        }
        ($keyword = $this->_request('keyword', 'trim')) && $map['title'] = array('like', '%'.$keyword.'%');
        $this->assign('search', array(
            'time_start' => $time_start,
            'time_end' => $time_end,
            'selected_ids' => $spid,
            'cate_id' => $cate_id,
            'keyword' => $keyword,
        ));
        //分页
        $count = $this->_mod->where($map)->count('id');
        $pager = new Page($count, 20);
        $select = $this->_mod->where($map)->order('id DESC');
        $select->limit($pager->firstRow.','.$pager->listRows);
				$select->order($sort . ' ' . $order);
        $page = $pager->show();
        $this->assign("page", $page);
        $listarr = $select->select();
        $lists = array();
        foreach($listarr as $key=>$val){
					$lists[$key]			= $val;
					$user	= M('user')->where(array('username'=>$val['uname']))->find();
				}

        $this->assign('list', $lists);
        $this->assign('list_table', true);
        $this->display();
    }


	/**
	 * 过期商品
	 */
	public function outtime(){
		if(IS_POST){
			$action	= $this->_post('action', 'trim');
			$where = '  pass=1  AND coupon_end_time <'.time();
			$this->_mod->where($where)->select();
		}else{
			if ($this->_request("sort", 'trim')) {
				$sort = $this->_request("sort", 'trim');
			} else {
				$sort = 'id';
			}
			if ($this->_request("order", 'trim')) {
				$order = $this->_request("order", 'trim');
			} else {
				$order = 'DESC';
			}
			$map['pass'] = 1 ;
			$map['coupon_end_time'] = array('elt', time()); 

			//分页
			$count = $this->_mod->where($map)->count('id');
			$pager = new Page($count, 20);
			$select = $this->_mod->where($map)->order('id DESC');
			$select->order($sort . ' ' . $order);
			$select->limit($pager->firstRow.','.$pager->listRows);
			$page = $pager->show();
			$this->assign("page", $page);
			$list = $select->select();

			$this->assign('list', $list);
			$this->assign('list_table', true);
			$this->display();
		}
	}


	/**
	 * 报名未通过
	 */
	public function fail(){
		
			if ($this->_request("sort", 'trim')) {
				$sort = $this->_request("sort", 'trim');
			} else {
				$sort = 'id';
			}
			if ($this->_request("order", 'trim')) {
				$order = $this->_request("order", 'trim');
			} else {
				$order = 'DESC';
			}
			$map['pass'] = 0 ;
			$map['status'] = 'fail'; 
			//分页
			$count = $this->_mod->where($map)->count('id');
			$pager = new Page($count, 20);
			$select = $this->_mod->where($map)->order('id DESC');
			$select->order($sort . ' ' . $order);
			$select->limit($pager->firstRow.','.$pager->listRows);
			$page = $pager->show();
			$this->assign("page", $page);
			$list = $select->select();

			$this->assign('list', $list);
			$this->assign('list_table', true);
			$this->display();
		
	}

	/**
     * 审核操作
     */
    public function add_time() {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
        $datas['id']=array('in',$ids);
        $datas['coupon_end_time']=time()+C('ftx_item_add_time')*3600;
        if ($datas) {
            if (false !== $mod->save($datas)) {
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
        }

    }

    /**
     * 审核操作
     */
    public function do_check() {
        $mod = D($this->_name);
        $pk = $mod->getPk();
        $ids = trim($this->_request($pk), ',');
        $datas['id']=array('in',$ids);
        $datas['pass']=1;
        if ($datas) {
            if (false !== $mod->save($datas)) {
                IS_AJAX && $this->ajaxReturn(1, L('operation_success'));
            } else {
                IS_AJAX && $this->ajaxReturn(0, L('operation_failure'));
            }
        } else {
            IS_AJAX && $this->ajaxReturn(0, L('illegal_parameters'));
        }
    }

	public function getcheck(){
		if(IS_POST){
			$id					= $this->_post('id', 'trim');
			$title				= $this->_post('title', 'trim');
			$coupon_start_time	= $this->_post('coupon_start_time', 'trim');
			$coupon_end_time	= $this->_post('coupon_end_time', 'trim');
			$pass				= $this->_post('pass', 'trim');
			$click_url				= $this->_post('click_url', 'trim');
			$fail_reason		= $this->_post('fail_reason', 'trim');
			$coupon_start_time	= strtotime($coupon_start_time);
			$coupon_end_time	= strtotime($coupon_end_time);
			$id = $this->_post('id', 'trim');
			if($pass == 0){
				$check_date['pass'] = 0;
				$check_date['fail_reason'] = $fail_reason;
				$check_date['status'] = 'fail';
				$this->_mod->where(array('id'=>$id))->save($check_date);
				$this->ajaxReturn(1, L('operation_success'));
			}else if($pass == 1){
				$check_date['pass'] = 1;
				$check_date['status'] = 'underway';
				$check_date['title'] = $title;
				$check_date['coupon_start_time'] = $coupon_start_time;
				$check_date['coupon_end_time'] = $coupon_end_time;
				$check_date['click_url'] = $click_url;
				$this->_mod->where(array('id'=>$id))->save($check_date);
				$this->ajaxReturn(1, L('operation_success'));
			}
		}else{
			$id = $this->_get('id', 'trim');
			!$id && $this->ajaxReturn(0, 'ID错误，请刷新');
			$item = $this->_mod->where(array('id'=>$id))->find();
			$this->assign('item', $item);
			$resp = $this->fetch();
			$this->ajaxReturn(1, '审核管理',$resp);
		}
	}

	/**
     * AJAX获取宝贝
     */
    public function ajaxgetid() {
$url = $this->_get("url","trim");
if ($url == "") {
$this->ajaxReturn(0,l("please_input") .l("correct_itemurl"));
}
if (!$this->get_id($url)) {
$this->ajaxReturn(0,l("please_input") .l("correct_itemurl"));
}
$iid = $this->get_id($url);
$items = m("items")->where(array(
"num_iid"=>$iid
))->find();
if ($items) {
$this->ajaxReturn(1005,l("item_exist"));
}
$itemcollect = new itemcollect( );
$itemcollect->url_parse($url);
if ($item = $itemcollect->fetch_tb()) {
$this->ajaxReturn(1,"",$item);
}
$this->ajaxReturn(0,l("item_not_excute"));
}

	public function get_id($url) {
$id = 0;
$parse = parse_url($url);
if (isset($parse['query'])) {
parse_str($parse['query'],$params);
if (isset($params['id'])) {
$id = $params['id'];
return $id;
}
if (isset($params['item_id'])) {
$id = $params['item_id'];
return $id;
}
if (isset($params['default_item_id'])) {
$id = $params['default_item_id'];
}
}
return $id;
}

    /**
     * ajax获取标签
     */
    public function ajax_gettags() {
$title = $this->_get("title","trim");
$tag_list = d("items")->get_tags_by_title($title);
$tags = implode(" ",$tag_list);
$this->ajaxReturn(1,l("operation_success"),$tags);
}

	public function ajax_getclick_url() {
        $iid = $this->_get('iid', 'trim');
		$url = 'http://item.taobao.com/item.htm?id='.$iid;
        $itemcollect = new itemcollect();
        $itemcollect->url_parse($url);
        $item = $itemcollect->fetch_tb();
        if ($item = $itemcollect->fetch_tb()){
			$this->ajaxReturn(1, L('operation_success'), $item['click_url']);
		}
        $this->ajaxReturn(0, L('operation_failure'));
    }
 
	public function http($url){
		set_time_limit(0);
		$result=file_get_contents($url);
		if($result===false){
			$curl=curl_init();
			curl_setopt($curl,CURLOPT_URL,$url);
			curl_setopt($curl,CURLOPT_HEADER,false);
			curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
			$result=curl_exec($curl);
			curl_close($curl);
		}
		if(empty($result)){
			$result=false;
		}
		return $result;
	}

	private function _get_ftx_top() {
        vendor('Ftxia.TopClient');
        vendor('Ftxia.RequestCheckUtil');
        vendor('Ftxia.Logger');
        $tb_top = new TopClient;
        $tb_top->appkey = $this->_ftxconfig['app_key'];
        $tb_top->secretKey = $this->_ftxconfig['app_secret'];
        return $tb_top;
    }
}
function getInfo($url){
		$u = parse_url($url);
		//解析get参数
		$param = convertUrlQuery($u['query']);
		$test['param']=$param;
		//var_dump($param);exit;
		if(!stripos('taobao.com',$u['host'])){
			$shopUrl = "http://hws.m.taobao.com/cache/wdetail/5.0/?id=".$param['id'];
		}else{
			$shopUrl = "http://detail.m.tmall.com/item.htm?id=".$param['id'];
		}		
	
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $shopUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($ch, CURLOPT_MAXREDIRS,2);
		$file_contents = curl_exec($ch);
		curl_close($ch);
		if(!$file_contents){
			$file_contents = file_get_contents($shopUrl);
		}
		if(!stripos('taobao.com',$u['host'] === false)){
			$data = getTaobaoShopInfo($file_contents);
		}else{
			$data = getTmallShopInfo($file_contents);
		}
		$data['num_iid'] = $param['id'];
		return $data;
	}
	//获取产品标题
	function getTaobaoShopInfo($content){
		$data = json_decode($content,true);		
		$info = array();
		$tmp = json_decode($data['data']['apiStack'][0]['value'],true);
		$info['title'] = $data['data']['itemInfoModel']['title'];
		$info['volume'] = $tmp['data']['itemInfoModel']['totalSoldQuantity'];
		$info['coupon_price'] = $tmp['data']['itemInfoModel']['priceUnits'][0]['price'];
		if(substr_count($info['coupon_price'],'-')){
			$tmp1 = explode('-',$info['coupon_price']);
			$info['coupon_price'] = min($tmp1[0],$tmp1[1]);
		}
		$info['price'] = $tmp['data']['itemInfoModel']['priceUnits'][1]['price'];
		if(substr_count($info['price'],'-')){
			$tmp = explode("-",$info['price']);
			$info['price'] = min($tmp[0],$tmp[1]);
		}		
		$info['pic_url'] = $data['data']['itemInfoModel']['picsPath'][0];
		$info['pic_url'] = str_replace("_320x320.jpg","",$info['pic_url']);
		$info['sellerId'] = $data['data']['seller']['userNumId'];
		$info['nick'] = $data['data']['seller']['nick'];		
		return $info;
	}
	function getTmallShopInfo($content){
	//	echo '<h1>Tmall</h1>';
		//标题正则

		$info = array();
		preg_match_all('/<title >(.*?) - 手机淘宝网 <\/title>/i',$content,$arr);
		$info['title'] = $arr[1][0];
		preg_match_all('/<strong class="oran">(.*?)<\/strong>/i',$content,$arr);
		$info['coupon_price'] = $arr[1][0];
		if(substr_count($info['coupon_price'],' - ')){
			$tmp1 = explode(' - ',$info['coupon_price']);
			$info['coupon_price'] = min($tmp1[0],$tmp1[1]);
		}
		preg_match_all('/<del class="gray">(.*?)<\/del>/i',$content,$arr);
		$info['price'] = $arr[1][0];
		if(substr_count($info['price'],' - ')){
			$tmp = explode(" - ",$info['price']);
			$info['price'] = min($tmp[0],$tmp[1]);
		}
		preg_match_all('/月&nbsp; 销&nbsp; 量：(.*?)<\/p>/si',$content,$arr);
		$info['volume'] = trim($arr[1][0]);
		preg_match_all('/<img alt=".*?" src="(.*?)" \/>/',$content,$arr);
		$info['pic_url'] = str_replace('170','320',$arr[1][0]);
		$info['pic_url'] = str_replace("_320x320.jpg","",$info['pic_url']);
		preg_match('/nick=(.+?)&/',$content,$nicks);
		$info['nick'] = urldecode($nicks[1]);
		return $info;
	}
	function convertUrlQuery($query)
	{
			$queryParts = explode('&', $query);
			$params = array();
			foreach ($queryParts as $param)
			{
				$item = explode('=', $param);
				$params[$item[0]] = $item[1];
			}
			return $params;
	}?>