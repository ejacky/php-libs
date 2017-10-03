<html>
<body>
<p>what are you doing?</p>
</body>
</html>
<?php
exit;
require_once 'vendor/autoload.php';

ORM::configure('mysql:host=localhost;dbname=test');
ORM::configure('username', 'root');
ORM::configure('password', '');

$db = ORM::get_db();

$db->exec("
        CREATE TABLE IF NOT EXISTS contact (
            id INTEGER PRIMARY KEY,
            name TEXT,
            email TEXT
        );"
);

// Handle POST submission
if (!empty($_POST)) {

    // Create a new contact object
    $contact = ORM::for_table('contact')->create();

    // SHOULD BE MORE ERROR CHECKING HERE!

    // Set the properties of the object
    $contact->name = $_POST['name'];
    $contact->email = $_POST['email'];

    // Save the object to the database
    $contact->save();

    // Redirect to self.
    header('Location: ' . basename(__FILE__));
    exit;
}

if (isset($_GET['id'])) {
    $model = ORM::for_table('contact')->find_one();
    $model->name = "just modify";
    if ($model->save()) {
        var_dump($model);
    }

}

// Get a list of all contacts from the database
$count = ORM::for_table('contact')->count();
$contact_list = ORM::for_table('contact')->find_many();


class Contact extends Model
{

}

//$test = Model::factory('Contact')->find_one(1)->as_array();
//var_dump($test);
?>


<html>
<head>
    <title>Idiorm Demo</title>
</head>

<body>

<h1>Idiorm Demo</h1>

<h2>Contact List (<?php echo $count; ?> contacts)</h2>
<ul>
    <?php foreach ($contact_list as $contact): ?>
        <li>
            <strong><?php echo $contact->name ?></strong>
            <a href="mailto:<?php echo $contact->email; ?>"><?php echo $contact->email; ?></a>
            <a href="?id=<?php echo $contact->id; ?>">编辑</a>
        </li>
    <?php endforeach; ?>
</ul>



<form method="post" action="">
    <h2>Add Contact</h2>
    <p><label for="name">Name:</label> <input type="text" name="name" /></p>
    <p><label for="email">Email:</label> <input type="email" name="email" /></p>
    <input type="submit" value="Create" />
</form>
</body>
</html>
