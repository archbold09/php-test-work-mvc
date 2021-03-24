<?php
require "../config/connection.php";

class inventory extends Connection {

	private $list;

	function __construct() {
		parent::__construct();
	}

	public function listProducts() {
		$sentence = $this->run("SELECT p.*, c.name AS category_name
			FROM products AS p
			LEFT JOIN categories AS c ON c.id_category = p.category_id
			WHERE p.state = 1
		");
		$this->list = $sentence->fetchAll( PDO::FETCH_ASSOC );

		return $this->list;
	}

	public function consult( $params ) {
		$id = $params['id'];
		$sentence = $this->runWithParams("SELECT p.*, c.name AS category_name
		FROM products AS p
		LEFT JOIN categories AS c ON c.id_category = p.category_id
		WHERE p.id_product = $id",$params);
		$this->list = $sentence->fetchAll( PDO::FETCH_ASSOC );
		return $this->list;
	}

	public function consultCategories() {
		$sentence = $this->run("SELECT *
			FROM categories WHERE state = 1
		");
		$this->list = $sentence->fetchAll( PDO::FETCH_ASSOC );

		return $this->list;
	}

	public function create( $params ) {
		$name = $params['name'];
		$price = $params['price'];
		$category = $params['category'];
		$amount = $params['amount'];
		$reference = $params['reference'];
		$sentence = $this->runWithParams("INSERT INTO products ( name, reference, price, category_id, amount)
		 VALUES ( '{$name}', '{$reference}', $price, $category, $amount )",$params);
		return $sentence;
	}

	public function updated( $params ) {
		$id = $params['id'];
		$name = $params['name'];
		$price = $params['price'];
		$category = $params['category'];

		$sentence = $this->runWithParams("UPDATE products SET name = '{$name}', price = $price, category_id = $category 
		WHERE id_product = $id",$params);
		return $sentence;
	}

//Eliminar
	public function delete( $params ) {
		$id = $params['id'];
		$sentence = $this->runWithParams("UPDATE products SET state = 0 WHERE id_product = $id",$params);
		return $sentence;
	}
}
?>