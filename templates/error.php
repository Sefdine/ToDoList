
<div class="container" style="text-align: center">
<?php
switch ($err) {
    case 'insert_success':
        echo "<div class='btn btn-success'>todo created successfully</div>";
        break;
    case 'insert_failed':
        echo "<div class='btn btn-danger'>todo creation failed</div>";
        break;
    case 'completed':
        echo "<div class='btn btn-success'>Task completed</div>";
        break;
    case 'uncompleted':
        echo "<div class='btn btn-success'>Task uncompleted</div>";
        break;
    case 'errcompleted':
        echo "<div class='btn btn-danger'>Error task uncompleted</div>";
        break;
    case 'deleted':
        echo "<div class='btn btn-success'>Task deleted</div>";
        break;
    case 'errdeleted':
        echo "<div class='btn btn-danger'>Error task undeleted</div>";
        break;
    case 'updated_success':
        echo "<div class='btn btn-success'>Task updated successfully</div>";
        break;
    case 'updated_failed':
        echo "<div class='btn btn-danger'>Error task not updated/div>";
        break;

}
?>
</div>
