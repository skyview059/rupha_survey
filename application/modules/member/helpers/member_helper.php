<?php defined('BASEPATH') OR exit('No direct script access allowed');

function memberTabs($id, $active_tab) {
	$html = '<ul class="tabsmenu">';
	$tabs = [
		'read' => 'Details',
		'update' => 'Update',
		'delete' => 'Delete',
		'annual_tax_assessments' => 'Annual Tax Assessment',
	];

	foreach ($tabs as $link => $tab) {
		$html .= '<li><a href="' . Backend_URL . "member/{$link}/{$id}\"";
		$html .= ($link == $active_tab) ? ' class="active"' : '';
		$html .= '>' . $tab . '</a></li>';
	}
	$html .= '</ul>';
	return $html;
}

function getSocialSecurityBenefit($selected_id = 0, $label = '-- নির্বাচন করুন --') {
	$ci = &get_instance();
	$ci->db->select('id,name_ba');
	$results = $ci->db->order_by('id', 'ASC')
		->get('social_security_benefits')
		->result();

	$row = '<option value="0">' . $label . '</option>';
	foreach ($results as $result) {
		$row .= '<option value="' . $result->id . '"';
		$row .= ($selected_id == $result->id) ? ' selected' : '';
		$row .= '>';
		$row .= $result->name_ba;
		$row .= '</option>' . "\r\n";
	}
	return $row;
}

function getAssetType($selected_id = 0, $label = '-- নির্বাচন করুন --') {
	$ci = &get_instance();
	$ci->db->select('id,name_ba');
	$results = $ci->db->order_by('id', 'ASC')
		->get('asset_types')
		->result();

	$row = '<option value="0">' . $label . '</option>';
	foreach ($results as $result) {
		$row .= '<option value="' . $result->id . '"';
		$row .= ($selected_id == $result->id) ? ' selected' : '';
		$row .= '>';
		$row .= $result->name_ba;
		$row .= '</option>' . "\r\n";
	}
	return $row;
}

function getIncomeSource($selected_id = 0, $label = '-- নির্বাচন করুন --') {
	$ci = &get_instance();
	$ci->db->select('id,name_ba');
	$results = $ci->db->order_by('id', 'ASC')
		->get('income_sources')
		->result();

	$row = '<option value="0">' . $label . '</option>';
	foreach ($results as $result) {
		$row .= '<option value="' . $result->id . '"';
		$row .= ($selected_id == $result->id) ? ' selected' : '';
		$row .= '>';
		$row .= $result->name_ba;
		$row .= '</option>' . "\r\n";
	}
	return $row;
}

function getDivisions($selected_id = 0, $label = '-- নির্বাচন করুন --') {
	$ci = &get_instance();
	$ci->db->select('id,bn_name');
	$results = $ci->db->order_by('id', 'ASC')
		->get('bd_divisions')
		->result();

	$row = '<option value="0">' . $label . '</option>';
	foreach ($results as $result) {
		$row .= '<option value="' . $result->id . '"';
		$row .= ($selected_id == $result->id) ? ' selected' : '';
		$row .= '>';
		$row .= $result->bn_name;
		$row .= '</option>' . "\r\n";
	}
	return $row;
}

function getDistricts($selected_id = 0, $division_id = 0, $label = '-- নির্বাচন করুন --') {
	$ci = &get_instance();
	$ci->db->select('id,bn_name');
	$results = $ci->db->order_by('id', 'ASC')
		->where('division_id', $division_id)
		->get('bd_districts')
		->result();

	$row = '<option value="0">' . $label . '</option>';
	foreach ($results as $result) {
		$row .= '<option value="' . $result->id . '"';
		$row .= ($selected_id == $result->id) ? ' selected' : '';
		$row .= '>';
		$row .= $result->bn_name;
		$row .= '</option>' . "\r\n";
	}
	return $row;
}

function getUpazilas($selected_id = 0, $district_id = 0, $label = '-- নির্বাচন করুন --') {
	$ci = &get_instance();
	$ci->db->select('id,bn_name');
	$results = $ci->db->order_by('id', 'ASC')
		->where('district_id', $district_id)
		->get('bd_upazilas')
		->result();

	$row = '<option value="0">' . $label . '</option>';
	foreach ($results as $result) {
		$row .= '<option value="' . $result->id . '"';
		$row .= ($selected_id == $result->id) ? ' selected' : '';
		$row .= '>';
		$row .= $result->bn_name;
		$row .= '</option>' . "\r\n";
	}
	return $row;
}

function getUnions($selected_id = 0, $upazilla_id = 0, $label = '-- নির্বাচন করুন --') {
	$ci = &get_instance();
	$ci->db->select('id,bn_name');
	$results = $ci->db->order_by('id', 'ASC')
		->where('upazilla_id', $upazilla_id)
		->get('bd_unions')
		->result();

	$row = '<option value="0">' . $label . '</option>';
	foreach ($results as $result) {
		$row .= '<option value="' . $result->id . '"';
		$row .= ($selected_id == $result->id) ? ' selected' : '';
		$row .= '>';
		$row .= $result->bn_name;
		$row .= '</option>' . "\r\n";
	}
	return $row;
}

