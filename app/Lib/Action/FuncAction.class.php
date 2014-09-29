<?php
/**
 * ��������
 */
class funcAction extends Action{


	/**
     * ����ʼ�������
     */
    protected function _mail_queue($to, $subject, $body, $priority = 1) {
        $to_emails = is_array($to) ? $to : array($to);
        $mails = array();
        $time = time();
        foreach ($to_emails as $_email) {
            $mails[] = array(
                'mail_to' => $_email,
                'mail_subject' => $subject,
                'mail_body' => $body,
                'priority' => $priority,
                'add_time' => $time,
                'lock_expiry' => $time,
            );
        }
        M('mail_queue')->addAll($mails);
        //�첽�����ʼ�
        $this->send_mail(true);
    }

    public function send_mail($is_sync = true) {
        if (!$is_sync) {
            //�첽
            session('async_sendmail', true);
            return true;
        } else {
            //ͬ��
            session('async_sendmail', null);
            return D('mail_queue')->send();
        }
    }

    protected function _upload_init($upload) {
        $allow_max = C('ftx_attr_allow_size'); //��ȡ����
        $allow_exts = explode(',', C('ftx_attr_allow_exts')); //��ȡ����
        $allow_max && $upload->maxSize = $allow_max * 1024;   //�ļ���С����
        $allow_exts && $upload->allowExts = $allow_exts;  //�ļ���������
        $upload->saveRule = 'uniqid';
        return $upload;
    }

    /**
     * �ϴ��ļ�
     */
    protected function _upload($file, $dir = '', $thumb = array(), $save_rule='uniqid') {
        $upload = new UploadFile();
        if ($dir) {
            $upload_path = C('ftx_attach_path') . $dir . '/';
            $upload->savePath = $upload_path;
        }
        if ($thumb) {
            $upload->thumb = true;
            $upload->thumbMaxWidth = $thumb['width'];
            $upload->thumbMaxHeight = $thumb['height'];
            $upload->thumbPrefix = '';
            $upload->thumbSuffix = isset($thumb['suffix']) ? $thumb['suffix'] : '_thumb';
            $upload->thumbExt = isset($thumb['ext']) ? $thumb['ext'] : '';
            $upload->thumbRemoveOrigin = isset($thumb['remove_origin']) ? true : false;
        }
        //�Զ����ϴ�����
        $upload = $this->_upload_init($upload);
        if( $save_rule!='uniqid' ){
            $upload->saveRule = $save_rule;
        }

        if ($result = $upload->uploadOne($file)) {
            return array('error'=>0, 'info'=>$result);
        } else {
            return array('error'=>1, 'info'=>$upload->getErrorMsg());
        }
    }

	protected function str_mid_replace($string) {
		if (! $string || !isset($string[1])) return $string;
		$len = strlen($string);
		$starNum = floor($len / 2); 
		$noStarNum = $len - $starNum;
		$leftNum = ceil($noStarNum / 2); 
		$starPos = $leftNum;
		for($i=0; $i<$starNum; $i++) $string[$starPos+$i] = '*';

		return $string;
	}

 
    protected function ajaxReturn($status=1, $msg='', $data='', $dialog='') {
        parent::ajaxReturn(array(
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
            'dialog' => $dialog,
        ));
    }

	protected function jsonReturn($data,$type='JSON'){
    	header('Content-Type:application/json; charset=utf-8');
    	exit(json_encode($data));
    }
}