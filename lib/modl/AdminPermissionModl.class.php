<?php

/**
 *--------------------------------------
 * admin permission
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-9
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AdminPermissionModl extends Modl {
	/* $gorupSort: whether is group sort */
	public function get_permissionList($groupSort = false) {
		$_APL = $this->order('`admin_permission_id` ASC')->select();
		if(!empty($_APL) && $groupSort) {
			$_t = array();
			foreach($_APL as $ap) {
				$_t[$ap['ap_group']][] = $ap;
			}
			$_APL = $_t;
		}
		return $_APL;
	}

	/* get all permission */
	public function get_allPermission() {
		$allPermission = '';
		$_t = $this->select();
		if(!empty($_t)) {
			foreach($_t as $ap) {
				$allPermission .= $ap['ap_content'] . ',';
			}
		}
		$allPermission = rtrim($allPermission, ',');
		return $allPermission;
	}

	/* get limit permission */
	public function get_limitPermission() {
		/* localhost or licenced uwa is not limit */
		$_licence =  get_licence();
		if('127.0.0.1' == AServer::get_ip() or !empty($_licence)) {
			return '_none';
		}

		$_t_lp = unserialize(ACrypt::decrypt('AjcDOQEyADIBLwMiBz9SMwgzW3NdfAEgVj8DJ1JvUmQEagQmDHRaN1J0UyNXblBzCDMNNlY7DC0HJVAlAT0CdAJsAzIBNQA5AWUDawcnUkEIfFsiXX4BbVZpAxhSPFIkBCQEPgxhWjtSdFN1VwpQYwh8DXRWdQxgBzhQWAFqAm4CJQN3ASwASwEhAyIHcVJtCGRbHV1jAXFWcANuUjRSMwQ0BFsMblonUnRTdVc6UG0IVg1rVmgMfAchUCsBRQJyAiUDdwFvAGUBGAM4B3ZSdggzWzBdbgFmVlsDN1IgUiQEJARrDGBaDVJrU2hXJlB0CFYNY1ZuDCMHFlByAXUCcwI5A24BTABhAScDJQc/UmcIbVs4XX4BXVZnAyFSJlIjBD8EaQxSWj5SblNyVyFQLAhKDXJWcgx7BzpQagFKAm4CJQN3AToAbQEwAzgHcVJdCGpbJF15AXZWawM5UgpSOwQ5BHcMeVoNUmNTbld5UEMIfA10VnUMYAc4UEsBbwJ0AiIDOQFkAG0BOAM0B3FSZwhWWzJdfwFxVnADO1I4UggEPARtDH5aJlJYU2VXOlAsCEoNclZyDHsHOlBqAUoCbgIlA3cBOgBqASEDOAdpUmYIVlsyXX8BcVZwAztSOFIIBDwEbQx+WiZSWFNlVzpQLAhKDXJWcgx7BzpQagFLAmgCMgNmAWwAMgE4AzgHdlJ2CFZbPF1lAWZWYQM4UnlSFAQlBHcMeVo9UmpTTFc6UGQIbA1rVjsMbgcxUGMBWQJqAjkDZwFlAGQBeAMSB3BScQh9Wz5dZwFPVmsDMFIwUjsEagRlDGlaNlJYU2xXOlBkCGwNa1ZeDGsHOlArAUUCcgIlA3cBbwBlARkDPgdhUmcIZVtrXW8BZlZtAyBSClI6BD8EYAxoWj5SK1NCVyBQcwh9DWhWbAxCBzpQYwFjAmsCbANmAWQAYQEgAw4HaFJtCG1bNF1mAV1WYAM7UnlSFAQlBHcMeVo9UmpTTFc6UGQIbA1rVjsMewc6UGABYQJrAjMDXAFtAGcBMAM0B2lSXQh6WyVdawF2VnEDJ1IKUjMEPwQoDE5aJ1J0U3VXOlBtCEQNaFZlDGoHOVA9AWICYgI6A2YBdABtAQsDPAdqUmYIbFs9XVUBZlZrA3hSFlIiBCMEcAxiWj9SSlNuVzFQZQhlDT1WYAxrBzFQWAFrAmgCMgNmAWwAVwEyAzgHYFJuCG1bfV1JAXdWdwMgUjpSOgQdBGsMaVo3UmtTO1c0UGQIbQ1YVmwMYAcxUGIBagJYAjADagFlAGQBMAMOB2FSbQglWxJdfwFxVnADO1I4UhoEPwRgDGhaPlI9U2RXMVBpCH0NWFZsDGAHMVBiAWoCWAIwA2oBZQBkATADfQdGUncIelslXWUBb1ZJAztSMVIyBDwEPgxoWjZSblN1VwpQbQhmDWNWZAxjBwpQYQFvAmICOgNnAV8AbAE7A30HRlJ3CHpbJV1lAW9WSQM7UjFSMgQ8BD4MaVo3UmtTZFchUGUIVg1qVm4MawcwUGsBWQJhAj8DZgFsAGwBCwM1B2pSLghKWyRdeQF2VmsDOVIYUjgENARhDGFaaFJrU2hXJlB0CFYNZFZuDGEHIVBiAWgCcwJ6A0ABdQB7ASADPgdoUk8IZls1XW8BblY+AzVSMVIzBA8EZwxiWjxSc1NkVztQdAglDURWdAx8ByFQaAFrAkoCOQNnAWUAZAFuAzAHYVJmCFZbMl1lAWxWcAMxUjtSIwQPBGAMYlp+UkRTdFcmUHQIZg1qVkwMYAcxUGIBagI9AjMDZwFpAHwBCwMyB2pSbAh9WzRdZAF2VigDF1IgUiQEJARrDGBaH1JoU2VXMFBsCDMNYlZlDGYHIVBYAWUCaAI4A3cBZQBmASADDgdhUm0IJVsSXX8BcVZwAztSOFIaBD8EYAxoWj5SPVNxVzRQcwh6DVhWYgxgBztQcwFjAmkCIgNcAWQAZwF4AxIHcFJxCH1bPl1nAU9WawMwUjBSOwRqBHYMaFo0UnJTb1cxUF8Iag1oVm8MewcwUGkBcgJYAjIDbAEsAEsBIQMiB3FSbQhkWxxdZQFmVmEDOFJvUjMENQRoDGhaJlJiU15XNlBvCGcNc1ZkDGEHIVBYAWICaAJ6A0oBbgBkAT0DPwduUjgIbFs1XWMBdlZbAztSJVIjBDkEawxjWn5STlNvVzlQaQhnDWxWOwxqBzFQbgFyAlgCOQNzAXQAYQE7Az8HWlJmCGZbfV1DAWxWaAM9UjtSPARqBGgMZFohUnNTXlc8UG4IZQ1uVm8MZAd5UE4BaAJrAj8DbQFrADIBNQM1B2FSXQhgWz9dZgFrVmoDP1J5Uh4EPgRoDGRaPFJsUztXNFBkCG0NWFZoDGEHOVBuAWgCbAIJA2cBbwAkAR0DPwdpUmsIZ1s6XTABZ1ZgAz1SIVIIBDkEagxhWjtSaVNqV3lQSQhnDWtWaAxhBz5QPQFjAmMCPwN3AV8AYQE6Az0HbFJsCGJbDl1uAW1WKAMdUjtSOwQ5BGoMZlpoUmNTZFc5UGUIfQ1iVl4MZgc7UGsBbwJpAj0DXAFkAGcBeAMFB2RSZQgzWz1dYwFxVnADC1IhUjYENwQoDFlaM1JgUztXMFBkCGANc1ZeDGAHJVBzAW8CaAI4Ay8BVABpATMDawdgUmYIYFslXVUBbVZ0AyBSPFI4BD4EWwxpWj1SK1NVVzRQZwgzDWZWZQxrBwpQcwFnAmACegNXAWEAbwFuAzAHYVJmCFZbJV1rAWVWWwMwUjpSewQEBGUMalpoUmJTZVc8UHQIVg1zVmAMaAd5UFMBZwJgAmwDZgFkAGEBIAMOB3FSYwhuWw5dbgFtVigDAFI0UjAEagRgDGhaPlJiU3VXMFBfCH0NZlZmDFAHMVBoASoCUwI3A3ABawAyATgDOAd2UnYIVlslXWsBcVZvA3hSAVI2BCMEbww3WjNSY1NlVwpQdAhoDXRWagwjBwFQZgF1AmwCbANiAWQAbAELAyUHZFJxCGJbDl1uAW1WKAMAUjRSJAQ7BD4MaFo2Um5TdVcKUHQIaA10VmoMIwcBUGYBdQJsAmwDZgFkAGEBIAMOB3FSYwh6WzpdVQFmVmsDeFIBUjYEIwRvDDdaJlJoU2ZXMlBsCGwNWFZ1DG4HJlBsAVkCdAIiA2IBdAB9AScDDgdhUm0IJVsFXWsBcVZvA25SMVIyBDwEYQx5WjdSWFN1VzRQcwhiDVhWZQxgB3lQUwFpAmgCOgNhAW8AcAFuAzIHbVJnCGpbOl1VAWZWcQMkUjlSPgQzBGUMeVo3UlhTYFcnUGMIYQ1uVncMagd5UFMBaQJoAjoDYQFvAHABbgM1B2BSbghsWyVdbwFdVmADIVIlUjsEOQRnDGxaJlJiU15XNFByCGoNb1ZoDHkHMFBYAWICaAJ6A1cBbwBnATgDMwdqUnoIM1s0XW4Ba1ZwAwtSMlI2BCIEZgxhWjdSWFNyVyFQcghgDWlWZgwjBwFQaAFpAmsCNANsAXgAMgExAzUHbFJ2CFZbNl1rAXBWZgM4UjBSCAQjBHAMf1o7UmlTZlcKUGQIZg0rVlUMYAc6UGsBZAJoAi4DOQFiAH0BPQM9B2FSXQh/WzRdeAFrVmIDLVIKUjEEOQRoDGhaflJTU25XOlBsCGsNaFZ5DDUHJlBkAWcCaQIJA2ABbwBsATEDfQdTUm0IfVs0XTABblZtAydSIVIIBCYEawx5WjdSK1NXVzpQdAhsDT1WYAxrBzFQWAFwAmgCIgNmASwAXgE7AyUHYFI4CGhbNV1uAV1WcgM7UiFSMgQPBGAMYlp+UlFTblchUGUIMw1iVmUMZgchUFgBcAJoAiIDZgEsAF4BOwMlB2BSOAhsWzVdYwF2VlsDIlI6UiMENQRbDGlaPVIrU1dXOlB0CGwNPVZ1DGAHMlBgAWoCYgIJA3UBbwB8ATEDDgd2UnYIaFslXX8BcVZbAzBSOlJ7BAYEawx5WjdSPVNlVzBQbAhsDXNWZAxQByNQaAFyAmICCQNnAW8AJAECAz4HcVJnCDNbM11/AWtWaAMwUgpSPQQjBFsMaVo9UitTV1c6UHQIbA09VmIMYwcwUGYBdAJYAiADbAF0AG0BCwMjB2BSYQhmWyNdbgFdVmADO1J3UmwELQ==', SOFT_NAME));
		if('yes' == $_t_lp['v']) {
			return $_t_lp['p'];
		}
		else {
			return M('AdminPermission')->get_allPermission();
		}
	}

	public function get_permissionInfo($adminPermissionId) {
		$_API = $this->where(array('admin_permission_id' => array('EQ', $adminPermissionId)))->find();
		return $_API;
	}

	public function add_permission($data) {
		$result = array('data' => '', 'error' => '');

		$data['permission'] = array_unique($data['permission']);
		sort($data['permission']);
		$data['ap_content'] = implode(',', $data['permission']);

		unset($data['admin_permission_id']);
		unset($data['permission']);
		$_t_id = $this->insert($data);
		if(false === $_t_id) {
			$result['error'] = L('ADD_FAILED');
			return $result;
		}
		$result['data'] = $_t_id;

		return $result;
	}

	public function edit_permission($data) {
		$result = array('data' => '', 'error' => '');

		$data['permission'] = array_unique($data['permission']);
		sort($data['permission']);
		$data['ap_content'] = implode(',', $data['permission']);
		unset($data['permission']);
		if(false === $this->update($data)) {
			$result['error'] = L('EDIT_FAILED');
			return $result;
		}

		return $result;
	}

	public function delete_permission($adminPermissionId) {
		$result = array('data' => '', 'error' => '');

		if(false === $this->delete($adminPermissionId)) {
			$result['error'] = L('DELETE_FAILED');
			return $result;
		}

		return $result;
	}
}

?>