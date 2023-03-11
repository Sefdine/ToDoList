
<?php ob_start() ?>

    <h1>Welcome to my To-DO List</h1>
    <br>
    <p class="news">You can now click on each of the tasks to display more information or to update it</p>
    <form action="index.php?action=submit_form_todo" method="post" class="form-todo">
        <div class="form-contr">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
        </div>
        <div class="form-contr">
            <label for="description">Description</label>
            <input type="text" name="description" id="description">
        </div>
        <input type="submit" value="Sumbit">
    </form>

<?php 
$content = ob_get_clean();
require_once('templates/layout.php'); 
?>
