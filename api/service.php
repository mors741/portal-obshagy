<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("general.php");

function get_user($req) {
	$db = get_db_connection();
	if ( array_key_exists('login', $req) ) {
		$where = ['login' => $req['login']];
	}
	else {
		$where = ['id' => $req['id']];
	}
	$select = [
		'id' => 'id',
		'login' => 'login',
		'fio' => 'fio',
		'address' => 'address',
	];
	$query = create_select($db, 'users_fio', $select , $where); 
	$res = $db->query($query);
	$res = $res->fetch_array(MYSQLI_ASSOC);
	return $res;
}

$create = function($req) {
	$ans = [];
	$error = false;
	$db = get_db_connection();
	$mandatory = ['login', 'performer_id', 'category_id', 'description', 'ordate', 'timeint'];
	foreach ($mandatory as $field) {
		if ( !array_key_exists($field, $req) ) {
			$error = true;
		}
	}

	if ( !$error ) {
		$request = [
			'owner' => get_user($req)['id'],
			'performer' => $req['performer_id'],
			'description' => $req['description'],
			'serv' => $req['category_id'],
			'ordate' => $req['ordate'],
			'timeint' => $req['timeint'],
			'date_create' => date("Y-m-d H:i:s"),
		];

		$query = create_insert($db, 'orders', $request);
		$res = $db->query($query);
		if ( $res == false ) {
			$error = true;
		} 
	}

	$ans['success'] = !$error; 
	return $ans; 
};

$set_state = function($req) {
	$ans = [];
	$error = false;
	$db = get_db_connection();
	
	$id = $req['id'];

	$set = [];
	$mandatory = ['state', 'mark', 'comment'];
	foreach ($mandatory as $field) {
		if ( array_key_exists($field, $req) ) {
			$set[$field] = $req[$field];
		}
	}

	$query = create_update($db, 'orders', $set, ['id' => $id]);
	$res = $db->query($query);
	if ( $res == false ) {
		$error = true;
	}
	$ans['success'] = !$error;
	return $ans;
};

$get_orders = function($req) {
	$ans = [];
	$error = false;
	$db = get_db_connection();

	$author_id =  get_user($req)['id'];
	$where = [
		'author_id' => $author_id,
	];

	$select = [
		'id' => 'id',
		'category' => 'category',
		'description' => 'description',
		'ordate' => 'ordate',
		'timeint' => 'timeint',
		'date_create' => 'date_create',
		'state' => 'state',
		'mark' => 'mark',
		'performer_id' => 'performer_id',
	];

	$query = create_select($db, 'orders_full', $select, $where);
	$res = $db->query($query);

	while ( $order = $res->fetch_array(MYSQLI_ASSOC) ) {
		$performer = get_user(['id' => $order['performer_id']]);
		if ( empty($performer) ) {
			$error = true;
		}
		$order = array_merge($order, ['performer' => $performer['fio']]);
		unset($order['performer_id']);
		$ans[] = $order;
	}
	$ans['success'] = !$error;
	return $ans;
};

$get_work = function($req) {
	$ans = [];
	$error = false;
	$db = get_db_connection();

	$where = [];
	if ( array_key_exists('login', $req) ) {
		$where['performer_id'] = $get_user($req)['id'];
	}

	if ( array_key_exists('mark', $req) ) {
		$where['mark'] = $req['mark'];
	}

	if ( array_key_exists('ordate', $req) ) {
		$where['ordate'] = $req['ordate'];
	}

	$select = [
		'id' => 'id',
		'author_id' => 'author_id',
		'description' => 'description',
		'ordate' => 'ordate',
		'timeint' => 'timeint',
		'date_create' => 'date_create',
		'state' => 'state',
		'mark' => 'mark',
		'comment' => 'comment',
		'performer_id' => 'performer_id'
	];

	$query = create_select($db, 'orders_full', $select, $where);
	$res = $db->query($query);

	while ( $order = $res->fetch_array(MYSQLI_ASSOC) ) {
		$performer = get_user(['id' => $order['performer_id']]);
		if ( empty($performer) ) {
			$error = true;
		}
		$order = array_merge($order, ['performer' => $performer['fio']]);
		unset($order['performer_id']);

		$author = get_user(['id' => $order['author_id']]);
		if ( empty($author) ) {
			$error = true;
		}
		$order = array_merge($order, ['author' => $author['fio'], 'address' => $author['address']]);
		unset($order['author_id']);

		$ans[] = $order;
	}
	$ans['success'] = !$error;
	return $ans;
};

$get_rating = function($req) {
	$ans = [];
	$error = false;
	$db = get_db_connection();

	$where = [];
	if ( array_key_exists('login', $req) ) {
		$where['uid'] = get_user($req)['id'];
	}

	$select = [
		'id' => 'id',
		'uid' => 'uid',
		'sid' => 'sid',
		'rating' => 'rating',
	];

	$query = create_select($db, 'staff', $select, $where);
	$res = $db->query($query);

	while ( $staff = $res->fetch_array(MYSQLI_ASSOC) ) {
		$performer = get_user(['id' => $staff['uid']]);
		if ( empty($performer) ) {
			$error = true;
		}
		$staff = array_merge($staff, ['performer' => $performer['fio']]);
		unset($staff['uid']);

		$query = create_select($db, 'service', ['name' => 'category'], ['id' => $staff['sid']]);
		$category = $db->query($query);
		$category = $category->fetch_array(MYSQLI_ASSOC);
		if ( empty($category) ) {
			$error = true;
		}
		$staff = array_merge($staff, $category);
		unset($staff['sid']);	
		$ans[] = $staff;
	}
	$ans['success'] = !$error;
	return $ans;
};

$delete = function($req) {
	$ans = [];
	$error = false;
	$db = get_db_connection();

	$id = $req['id'];
	$query = create_delete($db, 'orders', ['id' => $id]);
	$res = $db->query($query);
	if ( $res == false ) {
		$error = true;
	}
	$ans['success'] = !$error;
	return $ans;
};

$handlers = [
	'create' => $create,
	'set_state' => $set_state,
	'get_orders' => $get_orders,
	'get_work' => $get_work,
	'get_rating' => $get_rating,
	'delete' => $delete,
];

$req = get_json();
$type = $req['type'];
unset($req['type']);
if ( !array_key_exists($type, $handlers) ) {
	die("wrong type");
}

print (
	json_encode(
		$handlers[$type]($req)
		)
	);