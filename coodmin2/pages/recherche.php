<?php

require "../init.php";

$bdd = connectBdd();
$query = $bdd->prepare('SELECT bids.id AS bid_id, bids.title, bids.estimated_price, bids.descriptive, bids.image, bids.end_bid, bids.category, users.email, users.tel, users.pseudo, users.type, users.id AS user_id, users.surname, users.name, bid_user.bet_money, categories.name AS category_name
						FROM bids
						LEFT JOIN users ON users.id = bids.seller
						LEFT JOIN categories ON categories.id = bids.category
						LEFT JOIN bid_user ON bid_user.id_bid = bids.id
						WHERE categories.id IN (' . implode(',', $_POST['categories_de_recherche']) . ')');
$query->execute();
$bids = $query->fetchAll();

print_r(json_encode($bids));