<?php
/* What's the Problem? 
    - PHP logic + HTML in one file
    - Works, but not scalable
    - Repetition will become a problem

    How can we refactor this code so it’s easier to maintain?
*/

/*I learned how to store data in arrays 
and use functions to loop through them.*/ 

$items = ["Home", "About", "Contact"];

function itemLoop($items) {
    foreach($items as $item) {
        echo "<li>$item</li>";
    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>My PHP Page</title>
</head>
<body>

<h1>Welcome</h1>

<ul>
<?php itemLoop($items);?>
</ul>


<footer>
    <p>&copy; 2026</p>
</footer>

</body>
</html>
