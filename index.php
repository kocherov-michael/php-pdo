<?php 
//Вывод записей из БД по одной по порядку

/*$db = new PDO('mysql:host=localhost;dbname=filmoteka', 'root', '');
$sql = "SELECT * FROM films";
$result = $db->query($sql);

echo "<h2>Вывод записей из результата по одной: </h2>";
while ($film = $result->fetch(PDO::FETCH_ASSOC)){
	// print_r($film);
	echo "Название фильма: " . $film['title'] . "<br>";
	echo "Жанр фильма: " . $film['genre'] . "<br>";
	echo "<br><br>";
}*/
// echo "<hr />";


//Выборка всех записей в массив и вывод на экран

/*$db = new PDO('mysql:host=localhost;dbname=filmoteka', 'root', '');
$sql = "SELECT * FROM films";
$result = $db->query($sql);
$films = $result->fetchAll(PDO::FETCH_ASSOC);
echo "<h2>Выборка всех записей в массив и вывод на экран: </h2>";
foreach ($films as $film) {
	echo "Название фильма: " . $film['title'] . "<br>";
	echo "Жанр фильма: " . $film['genre'] . "<br>";
	echo "<br><br>";
}*/
// echo "<hr />";


//Выборка записей с привязкой данных к переменным

/*$db = new PDO('mysql:host=localhost;dbname=filmoteka', 'root', '');
$sql = "SELECT * FROM films";
$result = $db->query($sql);
$result->bindColumn('id', $id);
$result->bindColumn('title', $title);
$result->bindColumn('genre', $genre);
$result->bindColumn('year', $year);
echo "<h2>Выборка записей с привязкой данных к переменным: </h2>";
while ($result->fetch()) {
	echo "ID: {$id} <br>";
	echo "Название: {$title} <br>";
	echo "Жанр: {$genre} <br>";
	echo "год: {$year} <br>";
	echo "<br><br>";
}*/



//Выбор данных из БД с защитой

//1. Выборка без защиты от SQL инъекции

/*$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');
$username = 'Joker';
$password = '555';

$sql = "SELECT * FROM users WHERE name = '{$username}' AND password = '{$password}' LIMIT 1";
$result = $db->query($sql);
echo "<h2>Выборка без защиты от SQL инъекции: </h2>";
// print_r($result->fetch(PDO::FETCH_ASSOC));
if ($result->rowCount() == 1) {
	$user = $result->fetch(PDO::FETCH_ASSOC);
	echo "Имя пользователя: {$user['name']} <br>";
	echo "Email пользователя: {$user['email']} <br>";
}*/


// 2.Выборка с защитой от SQL инъекций - В РУЧНОМ режиме
/*$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');
$username = 'Joker';
$password = '555';

// $username = $db->quote( $username );//Экранирует, добавляя кавычки
$username = strtr($username , array(' ' => '_', '%' => '\%'));//Меняет одни символы на другие

// $password = $db->quote( $password );
$password = strtr($password , array(' ' => '_', '%' => '\%'));

$sql = "SELECT * FROM users WHERE name = '{$username}' AND password = '{$password}' LIMIT 1";
$result = $db->query($sql);

echo "<h2>Выборка с защитой от SQL инъекции в ручном режиме: </h2>";
// print_r($result->fetch(PDO::FETCH_ASSOC));
if ($result->rowCount() == 1) {
	$user = $result->fetch(PDO::FETCH_ASSOC);
	echo "Имя пользователя: {$user['name']} <br>";
	echo "Email пользователя: {$user['email']} <br>";
}*/

// 3.Выборка с защитой от SQL инъекций - В АВТОМАТИЧЕСКОМ режиме
/*$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');
$sql = "SELECT * FROM users WHERE name = :username AND password = :password LIMIT 1";
$stmt = $db->prepare($sql);//подготавливаем sql запрос
$username = 'Joker';
$password = '555';
$stmt ->bindValue(':username', $username);
$stmt ->bindValue(':password', $password);
$stmt ->execute();//выполняем
//Если не хотим для каждого значения вызывать метод bindValue, то можно сразу в ->execute
// $stmt ->execute(array(':username', $username, ':password', $password));
$stmt->bindColumn('name', $name);
$stmt->bindColumn('email', $email);
echo "<h2>Выборка с защитой от SQL инъекции в автоматическом режиме: </h2>";
$stmt->fetch();
echo "Имя пользователя: {$name} <br>";
echo "Email пользователя: {$email} <br>";

// 4.Выборка с защитой от SQL инъекций - В АВТОМАТИЧЕСКОМ режиме - ДРУГОЙ формат запроса
$sql = "SELECT * FROM users WHERE name = ? AND password = ? LIMIT 1";
$stmt = $db->prepare($sql);
$username = 'Joker';
$password = '555';
//$username = htmlentities($username);//преобразовывает "<" и ">" в "&lt" и "&gt"
$stmt ->bindValue(1, $username);
$stmt ->bindValue(2, $password);
$stmt ->execute();
//Если не хотим для каждого значения вызывать метод bindValue, то можно сразу в ->execute
// $stmt ->execute(array($username, $password));
$stmt->bindColumn('name', $name);
$stmt->bindColumn('email', $email);
echo "<h2>Выборка с защитой от SQL инъекции в автоматическом режиме: </h2>";
$stmt->fetch();
echo "Имя пользователя: {$name} <br>";
echo "Email пользователя: {$email} <br>";
*/


//Вставка данных в БД
/*$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');
//Готовим запрос в БД
$sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
$stmt = $db->prepare($sql);

$username = 'Flash';
$useremail = 'flash@gmail.com';

$stmt->bindValue(':name', $username);
$stmt->bindValue(':email', $useremail);
$stmt ->execute();
//либо такая запись:
// $stmt ->execute(array(':name'=> $username, ':email'=> $useremail));
echo "<p>Было затронуто строк: ". $stmt->rowCount() . "</p>";
*/

//Обновление данных в БД
/*$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');
// $sql = "UPDATE users SET name = :name WHERE id = :id";
//если надо несколько значений изменить
$sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
$stmt = $db->prepare($sql);

$username = "New Flash";
$useremail = '555flash@inbox.com';
$id = '6';

$stmt->bindValue(':name', $username);
$stmt->bindValue(':email', $useremail);
$stmt->bindValue(':id', $id);
$stmt ->execute();
echo "<p>Было затронуто строк: ". $stmt->rowCount() . "</p>";
*/

//Удаление из БД
$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');
$sql = "DELETE FROM users WHERE name = :name";
$stmt = $db->prepare($sql);

$username = "New Flash";

$stmt->bindValue(':name', $username);
$stmt ->execute();
echo "<p>Было затронуто строк: ". $stmt->rowCount() . "</p>";
?>