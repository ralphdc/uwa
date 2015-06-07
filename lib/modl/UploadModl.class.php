<?php

/**
 *--------------------------------------
 * upload
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-11-05
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class UploadModl extends Modl {
	/* upload list */
	public function get_uploadList($where, $order, $limit = 500) {
		$_UL = $this->where($where)->order($order)->limit($limit)->select();
		return $_UL;
	}

	public function get_uploadInfo($uploadId) {
		$_UI = $this->where(array('upload_id' => array('EQ', $uploadId)))->find();
		return $_UI;
	}

	public function edit_upload($data) {
		$result = array('data' => '', 'error' => '');

		$_t_id = $this->update($data);
		if(false === $_t_id) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		return $result;
	}

	public function delete_upload($uploadId) {
		$result = array('data' => '', 'error' => '');

		$_UI = $this->get_uploadInfo($uploadId);
		if(empty($_UI)) {
			$result['error'] = L('ITEM_NOT_EXIST');
			return $result;
		}

		if(false === $this->delete($uploadId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		/* delete file */
		if(__HOST__ == substr($_UI['u_src'], 0, strlen(__HOST__))) {
			@unlink(realpath($_SERVER['DOCUMENT_ROOT'] . substr($_UI['u_src'], strlen(__HOST__))));
		}
		else {
			@unlink(realpath($_SERVER['DOCUMENT_ROOT'] . $_UI['u_src']));
		}

		return $result;
	}

	/* upload file. $returnType:editor, normal */
	public function upload_file($field, $uploadType, $typeset = 'image', $thumb = 'no', $watermark = true, $returnType = 'normal', $fn = '', $memberInfo = null) {
		/* is the error request for editor */
		if('editor' == $returnType and empty($fn)) {
			return $this->_get_result('error', '', L('ERROR_REQUEST'), $returnType, 1);
		}

		if(empty($memberInfo)) {
			$o_upload = M('Option')->get_option('upload');
		}
		else {
			$o_upload = M('Upload')->get_uploadOption($memberInfo['member_level_id'], $memberInfo['member_id']);
		}
		$uploadDir = APP_PATH . D_S . trim($o_upload['dir'], '\\/') . D_S . $uploadType . (!empty($o_upload['sub_dir']) ? D_S . date(trim($o_upload['sub_dir'], '\\/')) : '');
		$uploadPath = __APP__ . $o_upload['dir'] . '/' . $uploadType . '/' . (!empty($o_upload['sub_dir']) ? date(trim($o_upload['sub_dir'], '\\/')) . '/' : '');

		$u_params = array();
		$u_params['uploadDir'] = $uploadDir;
		switch($typeset) {
			case 'image':
				$u_params['typeset'] = explode(',', $o_upload['imgtype']);
				break;
			case 'file':
				$u_params['typeset'] = explode(',', $o_upload['filetype']);
				break;
			case 'all':
				$u_params['typeset'] = array_merge(explode(',', $o_upload['imgtype']), explode(',', $o_upload['filetype']));
				break;
			default:
				$u_params['typeset'] = explode(',', $o_upload['imgtype']);
				break;
		}
		$u_params['maxSize'] = $o_upload['maxsize'] * 1024;
		$_u = get_instance('AUpload', $u_params);
		$upload = $_u->do_upload($field);
		$err = $_u->uploadError['msg'][0];
		if(!empty($err)) {
			return $this->_get_result('error', '', $err, $returnType, $fn);
		}

		if('image' == $typeset) {
			$o_image = M('Option')->get_option('image');
			$i_params = array();
			$i_params['sourceDir'] = $uploadDir;
			$i_params['outputDir'] = $uploadDir;
			$_i = get_instance('AImage', $i_params);

			if('yes' == $thumb or 'both' == $thumb) /* whether get thumbnail */ {
				$thumbImage = $_i->thumbnail($upload['name'], $o_image['thumb_width'], $o_image['thumb_height'], $o_image['thumb_prefix'], $o_image['thumb_proportional']);
				$err = $_i->imageError[0];
				if(!empty($err)) {
					return $this->_get_result('error', '', $err, $returnType, $fn);
				}
				$this->_insert_upload($upload['original_name'] . ' [' . L('THUMB') . ']', $thumbImage, $uploadPath, $uploadType);
			}

			if($watermark and $o_image['watermark'] and ('yes' != $thumb)) /* whether add watermark. do not add when only thumbnail */ {
				if($o_image['watermark_type']) {
					$watermarkImage = $_i->mark_text($upload['name'], array('size' => $o_image['watermark_text_size'], 'angle' => 0, 'color' => $o_image['watermark_text_color'], 'font' => PUBLIC_PATH . D_S . 'font' . D_S . $o_image['watermark_text_font'], 'text' => $o_image['watermark_text']), $o_image['watermark_position'], 'marked_');
				}
				else {
					$watermarkImage = $_i->mark($upload['name'], $_SERVER['DOCUMENT_ROOT'] . $o_image['watermark_image'], $o_image['watermark_position'], 'marked_');
				}
				$err = $_i->imageError[0];
				if(!empty($err)) {
					return $this->_get_result('error', '', $err, $returnType, $fn);
				}
				$this->_insert_upload($upload['original_name'] . ' [' . L('WATERMARK') . ']', $watermarkImage, $uploadPath, $uploadType);
				@unlink(realpath($uploadDir . D_S . $upload['name']));
				$upload['name'] = $watermarkImage['name'];
			}
			elseif('yes' != $thumb) /* do not insert to database when only get thumb */ {
				$this->_insert_upload($upload['original_name'], $upload, $uploadPath, $uploadType);
			}

			/* get return url */
			if('no' == $thumb) {
				$fileurl = $uploadPath . $upload['name'];
			}
			elseif('yes' == $thumb) {
				$fileurl = $uploadPath . $thumbImage['name'];
				@unlink(realpath($uploadDir . D_S . $upload['name']));
			}
			elseif('both' == $thumb) {
				$fileurl = $uploadPath . $thumbImage['name'] . '|' . $uploadPath . $upload['name'];
			}

		}
		else {
			$this->_insert_upload($upload['original_name'], $upload, $uploadPath, $uploadType);
			$fileurl = $uploadPath . $upload['name'];
		}

		return $this->_get_result('data', $fileurl, '', $returnType, $fn);
	}
	/* get result. $resultType:result type[error|data], $fileurl:file url, $message:message, $returnType:return data type, $fn:editor function id */
	private function _get_result($resultType, $fileurl, $message, $returnType, $fn) {
		$result = array('data' => '', 'error' => '');
		if('editor' == $returnType) {
			$result[$resultType] = '<script>window.parent.CKEDITOR.tools.callFunction(' . $fn . ', \'' . $fileurl . '\', \'' . $message . '\');</script>';
		}
		else {
			if('error' == $resultType) {
				$result['error'] = $message;
			}
			else {
				$result['data'] = $fileurl;
			}
		}
		return $result;
	}

	/* get thumb from content */
	public function get_thumb($content, $uploadType = 'archive', $memberInfo = null) {
		if(empty($memberInfo)) {
			$o_upload = M('Option')->get_option('upload');
		}
		else {
			$o_upload = M('Upload')->get_uploadOption($memberInfo['member_level_id'], $memberInfo['member_id']);
		}
		$o_image = M('Option')->get_option('image');

		$uploadDir = APP_PATH . D_S . trim($o_upload['dir'], '\\/') . D_S . $uploadType . (!empty($o_upload['sub_dir']) ? D_S . date(trim($o_upload['sub_dir'], '\\/')) : '');
		$uploadPath = __APP__ . $o_upload['dir'] . '/' . $uploadType . '/' . (!empty($o_upload['sub_dir']) ? date(trim($o_upload['sub_dir'], '\\/')) . '/' : '');

		$u_params = array();
		$u_params['uploadDir'] = $uploadDir;
		$u_params['typeset'] = explode(',', $o_upload['imgtype']);
		$u_params['maxSize'] = $o_upload['maxsize'] * 1024;
		$_u = get_instance('AUpload', $u_params);

		$i_params = array();
		$i_params['sourceDir'] = $uploadDir;
		$i_params['outputDir'] = $uploadDir;
		$_i = get_instance('AImage', $i_params);

		if(MAGIC_QUOTES_GPC) {
			$content = stripslashes($content);
		}
		preg_match_all('/<img.*?src=[\'|\"](.*?\.(?:' . str_replace(',', '|', $o_upload['imgtype']) . '))[\'|\"].*?\/>/si', $content, $file);
		$_t_thumb = $file[1][0];
		if(empty($_t_thumb)) {
			return '';
		}
		/* image in self server */
		if(!preg_match('/http:\/\//si', $_t_thumb)) {
			$_t_thumb = __HOST__ . $_t_thumb;
		}
		$localFile = $_u->save_remoteFile(trim($_t_thumb));

		$err = $_u->uploadError['msg'][0];
		if(!empty($err)) {
			return '';
		}

		$thumb = $_i->thumbnail($localFile['name'], $o_image['thumb_width'], $o_image['thumb_height'], $o_image['thumb_prefix'], $o_image['thumb_proportional']);
		@unlink(realpath($uploadDir . D_S . $localFile['name'])); /* delete temp image */

		$err = $_i->imageError[0];
		if(!empty($err)) {
			return '';
		}

		$filename = explode('/', $thumb['original_name']);
		$this->_insert_upload($filename[count($filename) - 1], $thumb, $uploadPath, $uploadType);

		return $uploadPath . $thumb['name'];
	}

	/* deal remote file */
	public function deal_reomote_file($content, $watermark = false, $uploadType = 'archive', $memberInfo = null) {
		if(empty($memberInfo)) {
			$o_upload = M('Option')->get_option('upload');
		}
		else {
			$o_upload = M('Upload')->get_uploadOption($memberInfo['member_level_id'], $memberInfo['member_id']);
		}
		$o_image = M('Option')->get_option('image');

		$uploadDir = APP_PATH . D_S . trim($o_upload['dir'], '\\/') . D_S . $uploadType . (!empty($o_upload['sub_dir']) ? D_S . date(trim($o_upload['sub_dir'], '\\/')) : '');
		$uploadPath = __APP__. $o_upload['dir'] . '/' . $uploadType . '/' . (!empty($o_upload['sub_dir']) ? date(trim($o_upload['sub_dir'], '\\/')) . '/' : '');

		$u_params = array();
		$u_params['uploadDir'] = $uploadDir;
		$u_params['typeset'] = array_merge(explode(',', $o_upload['imgtype']), explode(',', $o_upload['filetype']));
		$u_params['maxSize'] = $o_upload['maxsize'] * 1024;
		$_u = get_instance('AUpload', $u_params);

		$i_params = array();
		$i_params['sourceDir'] = $uploadDir;
		$i_params['outputDir'] = $uploadDir;
		$_i = get_instance('AImage', $i_params);
		$waterfile = $_SERVER['DOCUMENT_ROOT'] . $o_image['watermark_image'];

		if(MAGIC_QUOTES_GPC) {
			$content = stripslashes($content);
		}
		/* image */
		preg_match_all('/<img.*?src=[\'|\"](http\:\/\/.*?\.(?:' . str_replace(',', '|', $o_upload['imgtype']) . '))[\'|\"].*?\>/si', $content, $file);
		$file = array_unique($file[1]);
		foreach($file as $v) {
			$localFile = $_u->save_remoteFile(trim($v));
			$err = $_u->uploadError['msg'][0];
			if(!empty($err)) {
				continue;
			}

			/* add watermark */
			if($watermark) {
				if($o_image['watermark_type']) {
					$watermarkImage = $_i->mark_text($localFile['name'], array('size' => $o_image['watermark_text_size'], 'angle' => 0, 'color' => $o_image['watermark_text_color'], 'font' => PUBLIC_PATH . D_S . 'font' . D_S . $o_image['watermark_text_font'], 'text' => $o_image['watermark_text']), $o_image['watermark_position'], 'marked_');
				}
				else {
					$watermarkImage = $_i->mark($localFile['name'], $waterfile, $o_image['watermark_position'], 'marked_');
				}
				$err = $_i->imageError[0];
				if(empty($err)) {
					@unlink(realpath($uploadDir . D_S . $localFile['name']));
 					/* delete temp image */
					$localFile = $watermarkImage;
				}
			}

			$filename = explode('/', $localFile['original_name']);
			$this->_insert_upload($filename[count($filename) - 1], $localFile, $uploadPath, $uploadType);

			$content = str_ireplace($v, $uploadPath . $localFile['name'], $content);
		}
		/* resource */
		preg_match_all('/<a.*?href=[\'|\"](http\:\/\/.*?\.(?:' . str_replace(',', '|', $o_upload['filetype']) . '))[\'|\"].*?\>/si', $content, $file);
		$file = array_unique($file[1]);
		foreach($file as $v) {
			$localFile = $_u->save_remoteFile(trim($v));
			$err = $_u->uploadError['msg'][0];
			if(!empty($err)) {
				continue;
			}

			$filename = explode('/', $localFile['original_name']);
			$this->_insert_upload($filename[count($filename) - 1], $localFile, $uploadPath, $uploadType);

			$content = str_ireplace($v, $uploadPath . $localFile['name'], $content);
		}

		if(MAGIC_QUOTES_GPC) {
			$content = addslashes($content);
		}

		return $content;
	}

	/* update upload file */
	public function update_upload($uItemId, $memberId = '') {
		$upload = ASession::get('_upload');
		if(!empty($upload)) {
			$data = array();
			$data['u_item_id'] = $uItemId;
			if(!empty($memberId)) {
				$data['member_id'] = $memberId;
			}
			foreach($upload as $upload) {
				$this->where(array('u_src' => array('EQ', $upload)))->update($data);
			}
		}
		ASession::del('_upload');
	}

	/* insert temp upload file to database */
	private function _insert_upload($filename, $fileInfo, $uploadPath, $uploadType) {
		$_t_data = array();
		$_t_data['u_filename'] = $filename;
		$_t_data['u_src'] = $uploadPath . $fileInfo['name'];
		$_t_data['u_type'] = $fileInfo['type'];
		$_t_data['u_size'] = $fileInfo['size'];
		$_t_data['u_add_time'] = time();
		$_t_data['u_item_type'] = $uploadType;
		$_t_data['member_id'] = ASession::get('member_id');
		$this->insert($_t_data);
		/* record upload file */
		$uploadFile = ASession::get('_upload') ? ASession::get('_upload') : array();
		$uploadFile[] = $uploadPath . $fileInfo['name'];
		ASession::set('_upload', $uploadFile);
	}

	public function get_uploadOption($memberLevelId = 0, $memberId = 0) {
		$_OU = M('Option')->get_option('upload');

		if(0 < $memberLevelId and $_OU['switch']) {
			$_t_mli = M('MemberLevel')->get_levelInfo($memberLevelId);
			if(!empty($_t_mli)) {
				$_OU = array_merge($_OU, $_t_mli['ml_upload_option']);
				$_OU['imgtype'] = implode(',', $_OU['imgtype']);
				$_OU['filetype'] = implode(',', $_OU['filetype']);
			}
			else {
				$_OU['switch'] = false;
			}
		}

		if(0 < $memberId) {
			$spaceUsed = M('Upload')->where(array('member_id' => array('EQ', $memberId)))->sum('u_size');
			$spaceLeft = $_OU['space'] * 1024 - $spaceUsed;
			$_OU['maxsize'] = ($spaceLeft > $_OU['maxsize'] * 1024 ? $_OU['maxsize'] : $spaceLeft / 1024);
		}

		$_OU['img'] = '*.' . implode(';*.', explode(',', $_OU['imgtype']));
		$_OU['file'] = '*.' . implode(';*.', explode(',', $_OU['filetype']));
		$_OU['all'] = implode(';', array($_OU['img'], $_OU['file']));
		$_OU['space_used_format'] = byte_format($spaceUsed);
		$_OU['space_format'] = byte_format($_OU['space'] * 1024);
		$_OU['maxsize_format'] = byte_format($_OU['maxsize'] * 1024);

		if($_OU['switch']) {
			$_OU['upload_tip'] = array(
				L('FILE_TYPE') . ': ' . $_OU['all'],
				L('IMAGE_TYPE') . ': ' . $_OU['img'],
				L('SPACE_USEAGE') . ': ' . $_OU['space_used_format'] . '/' . $_OU['space_format'],
				L('FILE_MAXSIZE') . ': ' . $_OU['maxsize_format']);
		}
		else {
			$_OU['upload_tip'] = array(L('UPLOAD_IS_OFF'));
		}
		return $_OU;
	}

}

?>